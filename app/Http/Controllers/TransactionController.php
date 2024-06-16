<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $savingsAccounts = SavingsAccount::all();
        return view('transactions.form', compact('savingsAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'savings_account_id' => 'required|exists:savings_accounts,_id',
            'tipo' => 'required',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'estado' => 'required'
        ]);

        Transaction::create($validated);

        return redirect()->route("transactions.index")->with([
            "message"=> "Registro creado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $savingsAccounts = SavingsAccount::all();
        return view('transactions.form', compact('transaction', 'savingsAccounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'savings_account_id' => 'required|exists:savings_accounts,_id',
            'tipo' => 'required',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'estado' => 'required'
        ]);

        $transaction->update($validated);

        return redirect()->route("transactions.index")->with([
            "message"=> "Registro actualizado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route("transactions.index")->with([
            "message"=> "Registro eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
