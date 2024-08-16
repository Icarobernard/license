<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Offer;
use App\Models\License;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::where('user_id', Auth::user()->id)->with('license')->get();
        $licenses = License::where('email', Auth::user()->email)
            ->where('status', '!=', 'inactive')
            ->get();

        return view('domains.index', compact('domains', 'licenses'));
    }

    public function sanitizeDomain($str)
    {
        // Remove acentuações
        $str = strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

        // Remove http://, https:// e www
        $str = preg_replace('/^https?:\/\//', '', $str);
        $str = preg_replace('/^www\./', '', $str);

        return $str;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = $this->sanitizeDomain($data['name']);

        $license = License::find($request->license_id);

        if (!$license) {
            return redirect()->back()->with('error', 'Licença não encontrada.');
        }

        $offer = Offer::find($license->offer_id);

        if (!$offer) {
            return redirect()->back()->with('error', 'Oferta não encontrada.');
        }

        $product = Product::find($offer->product_id);

        // Verifica se o domínio principal existe
        $mainDomain = $this->getMainDomain($data['name']);

        // Buscar domínios semelhantes
        $existingMainDomain = Domain::where('name', $mainDomain)->where('user_id', Auth::user()->id)->first();

        if (!$existingMainDomain && $this->isSubdomain($data['name'])) {
            return redirect()->back()->with('error', 'Domínio principal não encontrado.');
        }

        // Verifica se o domínio ou subdomínio já existe
        $existingUserDomain = Domain::where('name', $data['name'])->where('user_id', Auth::user()->id)->first();

        if ($existingUserDomain) {
            return redirect()->back()->with('error', 'Domínio já existe.');
        }
        
        $existingLicense = License::where('verification_code', $product->unlimited_subdomain_id)->where('email', Auth::user()->email)->first();
        // Verifica a quantidade de domínios permitidos
        if($product->unlimited_subdomain_id && $existingLicense){
            $currentDomainsCount = Domain::where('license_id', $license->id)->where('is_subdomain', false)->count();
        } else {
            $currentDomainsCount = Domain::where('license_id', $license->id)->count();
        }
        

        // Se o domínio principal existe ou o número de domínios excede o limite, permite criar subdomínios ilimitados
        if ($existingMainDomain && ($currentDomainsCount >= $offer->licenses && $product->unlimited_subdomain_id)) {
            Domain::create([
                'name' => $data['name'],
                'license_id' => $request->license_id,
                'user_id' => Auth::user()->id,
                'is_subdomain' => $this->isSubdomain($data['name']),
                'parent_id' => $existingMainDomain->id
            ]);

            return redirect()->route('domains.index')->with('success', 'Subdomínio adicionado com sucesso.');
        }

        // Se a quantidade de domínios não excedeu o limite, cria um novo domínio
        if ($currentDomainsCount < $offer->licenses) {
            Domain::create([
                'name' => $data['name'],
                'license_id' => $request->license_id,
                'user_id' => Auth::user()->id,
                'is_subdomain' => $this->isSubdomain($data['name']),
                // 'parent_id' => $existingMainDomain->id
            ]);

            return redirect()->route('domains.index')->with('success', 'Domínio adicionado com sucesso.');
        }
        return redirect()->back()->with('error', 'Quantidade de domínios excedeu o limite, compre mais');
    }

    public function edit($id)
    {
        $domain = Domain::findOrFail($id);
        $licenses = License::where('email', Auth::user()->email)->get();

        return view('domains.edit', compact('domain', 'licenses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|url',
            'license_id' => 'required|exists:licenses,id',
        ]);

        $domain = Domain::findOrFail($id);
        $domain->update([
            'name' => $request->name,
            'license_id' => $request->license_id,
        ]);

        return redirect()->route('domains.index')->with('success', 'Domínio atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        $mainDomain = $this->getMainDomain($domain->name);

        if ($this->isSubdomain($domain->name)) {
            // Se for um subdomínio, exclui apenas o subdomínio
            $domain->delete();
            return redirect()->route('domains.index')->with('success', 'Subdomínio excluído com sucesso.');
        } else {
            // Se for um domínio principal, exclui todos os domínios relacionados
            Domain::where('license_id', $domain->license_id)
                ->where(function ($query) use ($mainDomain) {
                    $query->where('name', 'LIKE', "%.$mainDomain")
                        ->orWhere('name', $mainDomain);
                })
                ->delete();

            return redirect()->route('domains.index')->with('success', 'Domínio e subdomínios excluídos com sucesso.');
        }
    }

    private function isSubdomain($domain)
    {
        $parts = explode('.', $domain);
        $numParts = count($parts);
    
        // Lista de domínios de segundo nível comuns
        $secondLevelDomains = config('domain.second_level_domains');
    
        if ($numParts > 2) {
            $secondLevelDomain = implode('.', array_slice($parts, -2));
            if (in_array($secondLevelDomain, $secondLevelDomains)) {
                return $numParts > 3;
            }
        }
    
        return $numParts > 2;
    }
    
    private function getMainDomain($domain)
    {
        $parts = explode('.', $domain);
        $numParts = count($parts);
    
        // Lista de domínios de segundo nível comuns
        $secondLevelDomains = config('domain.second_level_domains');
    
        if ($numParts > 2) {
            $secondLevelDomain = implode('.', array_slice($parts, -2));
            if (in_array($secondLevelDomain, $secondLevelDomains)) {
                return implode('.', array_slice($parts, -3));
            }
        }
    
        return implode('.', array_slice($parts, -2));
    }
    
}
