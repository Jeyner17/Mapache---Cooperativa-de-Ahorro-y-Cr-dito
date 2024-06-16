<?php

namespace App\Http\Controllers;

use App\Models\SavingsQuota;
use App\Models\Member;
use Illuminate\Http\Request;

class SavingsQuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savingsQuotas = SavingsQuota::all();
        return view('savings_quotas.index', compact('savingsQuotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        return view('savings_quotas.form', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,_id',
            'monto' => 'required|numeric',
            'fecha_semana' => 'required|date',
            'estado' => 'required'
        ]);

        SavingsQuota::create($validated);

        return redirect()->route("savings_quotas.index")->with([
            "message"=> "Registro creado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SavingsQuota $savingsQuota)
    {
        return view('savings_quotas.show', compact('savingsQuota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavingsQuota $savingsQuota)
    {
        $members = Member::all();
        return view('savings_quotas.form', compact('savingsQuota', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavingsQuota $savingsQuota)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,_id',
            'monto' => 'required|numeric',
            'fecha_semana' => 'required|date',
            'estado' => 'required'
        ]);

        $savingsQuota->update($validated);

        return redirect()->route("savings_quotas.index")->with([
            "message"=> "Registro actualizado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavingsQuota $savingsQuota)
    {
        $savingsQuota->delete();

        return redirect()->route("savings_quotas.index")->with([
            "message"=> "Registro eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
