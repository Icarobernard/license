<?php
// app/Http/Controllers/LicenseController.php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Domain;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\WebhookLog;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::all();
        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_key' => 'required|unique:licenses',
            'license_name' => 'required',
            'transaction' => 'required',
            'subscriber_code' => 'required',
            'status' => 'required',
            'expiration_date' => 'required|date',
            'email' => 'required|email',
            'client_name' => 'required',
            'offer_id' => 'required|exists:offers,id',
        ]);

        License::create($request->all());

        return redirect()->route('licenses.index')->with('success', 'Licença criada com sucesso!');
    }

    public function show($id)
    {
        $license = License::findOrFail($id);
        return view('licenses.show', compact('license'));
    }

    public function edit($id)
    {
        $license = License::findOrFail($id);
        $offers = Offer::all();
        return view('licenses.edit', compact('license', 'offers'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'license_key' => 'required|string|max:255',
            'license_name' => 'required|string|max:255',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'expiration_date' => 'nullable|date',
            'email' => 'required|email|max:255',
            'client_name' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->route('licenses.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $license = License::findOrFail($id);

        $license->license_key = $request->input('license_key');
        $license->license_name = $request->input('license_name');
        $license->status = $request->input('status');
        $license->expiration_date = $request->input('expiration_date');
        $license->email = $request->input('email');
        $license->client_name = $request->input('client_name');
        $license->offer_id = $request->input('offer_id');

        $license->save();

        return redirect()->route('licenses.update', $license->id)
            ->with('success', 'Licença atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();

        return redirect()->route('licenses.index')->with('success', 'Licença deletada com sucesso!');
    }

    public function handleWebhook(Request $request)
    {
        $dados = $request->all();
        $dataAtual = new DateTime();

        try {
            if (isset($dados['data'])) {
                $subscriberCode = $dados['data']['subscription']['subscriber']['code'];
                $user = $dados['data']['buyer'];
                $purchase = $dados['data']['purchase'];
                $offerCode = $purchase['offer']['code'];
                $event = $dados['event'];
                $transaction = $purchase['transaction'];
                $productData = $dados['data']['product'];

                $product = Product::where('product_id', $offerCode)->first();
                $existingAnySupportToProduct = Product::where('unlimited_subdomain_id', $offerCode)
                ->orWhere('support_id', $offerCode)
                ->orWhere('update_id', $offerCode)
                ->first();
                if (!$product && !$existingAnySupportToProduct) {
                    throw new \Exception('Produto não encontrado');
                }

                $offer = Offer::where('product_id', $product->id)->first();
                if (!$offer && !$existingAnySupportToProduct) {
                    throw new \Exception('Oferta não encontrada para o produto');
                }


                $existingLicense = License::where('transaction', $transaction)->first();

                if ($existingLicense) {
                    if (in_array($event, ['CHARGEBACK', 'REFUNDED', 'PURCHASE_CANCELED'])) {
                        $existingLicense->update([
                            'status' => 'inactive',
                            'updated_at' => $dataAtual
                        ]);
                    }
                    throw new \Exception('Licença já foi gerada');
                }

                if ($offer->type === 'subscription') {
                    $existingSubscriberCode = License::where('subscriber_code', $subscriberCode)->where('offer_id', $offer->id)->first();
                    if ($existingSubscriberCode) {
                        if ($event === 'PURCHASE_APPROVED') {

                            $expirationDate = new DateTime($existingSubscriberCode->expiration_date);
                            $this->createExpirationDate($offer, $expirationDate);

                            $existingSubscriberCode->update([
                                'expiration_date' => $expirationDate,
                                'updated_at' => $dataAtual
                            ]);

                            return response()->json(['message' => 'Licença existente atualizada'], 200);
                        } else {
                            throw new \Exception('Licença já foi gerada para este subscriber code');
                        }
                    }
                    if ($subscriberCode && $offer->type === 'lifetime') {
                        throw new \Exception('Erro na configuração, a oferta não é vitalícia');
                    }
                }

                $expirationDate = $dataAtual;
                if ($offer->type === 'lifetime') {
                    $expirationDate->modify('+20 years');
                } else if ($offer->type === 'subscription') {
                    if (!isset($offer->subscription_type) || !isset($offer->subscription_quantity)) {
                        throw new \Exception('Tipo de assinatura ou quantidade de assinaturas não definido');
                    }
                    $this->createExpirationDate($offer, $expirationDate);
                }

                License::create([
                    'license_name' => $productData["name"],
                    'license_key' => str()->random(20),
                    'transaction' => $transaction,
                    'subscriber_code' => $subscriberCode,
                    'expiration_date' => $expirationDate,
                    'email' => $user['email'],
                    'client_name' => $user['name'],
                    'status' => 'active',
                    'offer_id' => $offer->id ? $offer->id : 0,
                    'verification_code' => $offerCode,
                    'total_amount' => $purchase['original_offer_price']['value']
                ]);

                return response()->json(['message' => 'Webhook gerado'], 200);
            }

            throw new \Exception('Dados inválidos');
        } catch (\Exception $e) {
            WebhookLog::create([
                'email' => $dados['data']['buyer']['email'] ?? '',
                'phone' => $dados['data']['buyer']['checkout_phone'] ?? '',
                'error_description' => $e->getMessage(),
            ]);

            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function createExpirationDate($offer, $expirationDate) {

        switch ($offer->subscription_type) {
            case 'annual':
                $expirationDate->modify('+' . $offer->subscription_quantity . ' years');
                break;
            case 'monthly':
                $expirationDate->modify('+' . $offer->subscription_quantity . ' months');
                break;
            case 'weekly':
                $expirationDate->modify('+' . $offer->subscription_quantity . ' weeks');
                break;
            default:
                throw new \Exception('Tipo de assinatura inválida');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $licenses = License::where('license_name', 'LIKE', "%{$search}%")
                ->orWhere('license_key', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('client_name', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $licenses = License::all();
        }
    
        return view('licenses.index', compact('licenses'))->with('search', $search);
    }
    public function checkStatus($license_key)
    {
        $license = License::where('license_key', $license_key)->first();
    
        if ($license) {
         
            $domains = Domain::where('license_id', $license->id)->pluck('name');
    
            return response()->json([
                'license_key' => $license->license_key,
                'status' => $license->status,
                'domains' => $domains
            ]);
        } else {
            return response()->json([
                'message' => 'License not found',
            ], 404);
        }
    }
    
}
