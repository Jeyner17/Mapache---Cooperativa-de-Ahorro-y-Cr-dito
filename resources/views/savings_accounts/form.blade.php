@extends('adminlte::page')

@section('title', isset($savingsAccount) ? 'Editar Cuenta de Ahorro' : 'Nueva Cuenta de Ahorro')

@section('content_header')
    <h1>{{ isset($savingsAccount) ? 'Editar Cuenta de Ahorro' : 'Nueva Cuenta de Ahorro' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($savingsAccount))
                <form action="{{ route('savings_accounts.update', ['savings_account' => $savingsAccount->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('savings_accounts.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="member_id">Miembro</label>
                        <select class="form-control" id="member_id" name="member_id">
                            @foreach($members as $member)
                                <option value="{{ $member->_id }}" {{ isset($savingsAccount) && $savingsAccount->member_id == $member->_id ? 'selected' : '' }}>
                                    {{ $member->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numero_cuenta">Número de Cuenta</label>
                        <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" value="{{ old('numero_cuenta', isset($savingsAccount) ? $savingsAccount->numero_cuenta : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="saldo">Saldo</label>
                        <input type="number" step="any" class="form-control" id="saldo" name="saldo" value="{{ old('saldo', isset($savingsAccount) ? $savingsAccount->saldo : '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Código JavaScript personalizado si es necesario
        });
    </script>
@stop
