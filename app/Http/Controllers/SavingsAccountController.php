<?php

namespace App\Http\Controllers;

use App\Models\SavingsAccount;
use App\Models\Member;
use Illuminate\Http\Request;

class SavingsAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savingsAccounts = SavingsAccount::with('member')->get();
        return view('savings_accounts.index', compact('savingsAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        return view('savings_accounts.form', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,_id',
            'numero_cuenta' => 'required',
            'saldo' => 'required|numeric'
        ]);

        SavingsAccount::create($validated);

        return redirect()->route("savings_accounts.index")->with([
            "message" => "Registro creado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavingsAccount $savingsAccount)
    {
        $members = Member::all();
        return view('savings_accounts.form', compact('savingsAccount', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavingsAccount $savingsAccount)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,_id',
            'numero_cuenta' => 'required',
            'saldo' => 'required|numeric'
        ]);

        $savingsAccount->update($validated);

        return redirect()->route("savings_accounts.index")->with([
            "message" => "Registro actualizado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavingsAccount $savingsAccount)
    {
        $savingsAccount->delete();

        return redirect()->route("savings_accounts.index")->with([
            "message" => "Registro eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
