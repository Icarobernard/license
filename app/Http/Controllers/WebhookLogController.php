<?php
namespace App\Http\Controllers;

use App\Models\WebhookLog;
use Illuminate\Http\Request;

class WebhookLogController extends Controller
{
    public function index()
    {
        $logs = WebhookLog::all();
        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'error_description' => 'required|string',
        ]);

        WebhookLog::create($request->all());

        return redirect()->route('logs.index')->with('success', 'Log criado com sucesso!');
    }

    public function show($id)
    {
        $log = WebhookLog::findOrFail($id);
        return view('logs.show', compact('log'));
    }

    public function destroy($id)
    {
        $log = WebhookLog::findOrFail($id);
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log deletado com sucesso.');
    }
}
