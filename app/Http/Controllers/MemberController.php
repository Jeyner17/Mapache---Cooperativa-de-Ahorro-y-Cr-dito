<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s]+$/u|max:255',
            'apellido' => 'required|string|regex:/^[\pL\s]+$/u|max:255',
            'cedula' => 'required|numeric|digits:10|unique:members,cedula',
            'email' => 'required|string|email|max:255|unique:members,email',
            'direccion.calle' => 'required|string|max:255',
            'direccion.numero' => 'required|string|max:50',
            'direccion.calle_secundaria' => 'nullable|string|max:255',
            'direccion.ciudad' => 'required|string|max:255',
            'telefono' => 'required|array|min:1',
            'telefono.*' => 'required|numeric|digits:10',
            'estado' => 'required|string|in:activo,inactivo,suspendido',
        ], [
            'nombre.regex' => 'El campo nombre solo puede contener letras.',
            'apellido.regex' => 'El campo apellido solo puede contener letras.',
            'cedula.digits' => 'El campo cédula debe tener exactamente 10 dígitos.',
            'cedula.numeric' => 'El campo cédula solo puede contener números.',
            'telefono.*.digits' => 'Cada número de teléfono debe tener exactamente 10 dígitos.',
            'telefono.*.numeric' => 'Cada número de teléfono solo puede contener números.',
        ]);

        Member::create($validated);

        return redirect()->route("members.index")->with([
            "message" => "Registro creado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.form', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s]+$/u|max:255',
            'apellido' => 'required|string|regex:/^[\pL\s]+$/u|max:255',
            'cedula' => 'required|numeric|digits:10|unique:members,cedula,' . $member->_id,
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->_id,
            'direccion.calle' => 'required|string|max:255',
            'direccion.numero' => 'required|string|max:50',
            'direccion.calle_secundaria' => 'nullable|string|max:255',
            'direccion.ciudad' => 'required|string|max:255',
            'telefono' => 'required|array|min:1',
            'telefono.*' => 'required|numeric|digits:10',
            'estado' => 'required|string|in:activo,inactivo,suspendido',
        ], [
            'nombre.regex' => 'El campo nombre solo puede contener letras.',
            'apellido.regex' => 'El campo apellido solo puede contener letras.',
            'cedula.digits' => 'El campo cédula debe tener exactamente 10 dígitos.',
            'cedula.numeric' => 'El campo cédula solo puede contener números.',
            'telefono.*.digits' => 'Cada número de teléfono debe tener exactamente 10 dígitos.',
            'telefono.*.numeric' => 'Cada número de teléfono solo puede contener números.',
        ]);

        $member->update($validated);

        return redirect()->route("members.index")->with([
            "message" => "Registro actualizado exitosamente",
            "type" => "success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route("members.index")->with([
            "message" => "Registro eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
