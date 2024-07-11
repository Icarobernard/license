<?php
// app/Http/Controllers/LicenseController.php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

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
        return view('licenses.edit', compact('license'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'license_key' => 'required|unique:licenses,license_key,' . $id,
            'license_name' => 'required',
            'status' => 'required',
            'expiration_date' => 'required|date',
            'email' => 'required|email',
            'client_name' => 'required',
            'offer_id' => 'required|exists:offers,id',
        ]);

        $license = License::findOrFail($id);
        $license->update($request->all());

        return redirect()->route('licenses.index')->with('success', 'License updated successfully.');
    }

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();

        return redirect()->route('licenses.index')->with('success', 'License deleted successfully.');
    }

    public function handleWebhook(Request $request)
    {
        // Validate webhook payload
        $request->validate([
            'event' => 'required|string',
            'data' => 'required|array',
        ]);

        // Handle webhook event
        $event = $request->input('event');
        $data = $request->input('data');

        // Example: Generate a new license on a specific event
        if ($event == 'PURCHASE_APPROVED') {
            License::create([
                'license_key' => uniqid('license_'),
                'license_name' => $data['offer']['name'],
                'status' => 'active',
                'expiration_date' => now()->addYear(),
                'email' => $data['buyer']['email'],
                'client_name' => $data['buyer']['name'],
                'offer_id' => $data['offer']['id'],
            ]);
        }

        return response()->json(['message' => 'Webhook handled'], 200);
    }
}
