@extends('adminlte::page')

@section('title', isset($transaction) ? 'Editar Transacción' : 'Nueva Transacción')

@section('content_header')
    <h1>{{ isset($transaction) ? 'Editar Transacción' : 'Nueva Transacción' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($transaction))
                <form action="{{ route('transactions.update', ['transaction' => $transaction->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('transactions.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="savings_account_id">Cuenta de Ahorro</label>
                        <select class="form-control" id="savings_account_id" name="savings_account_id" required>
                            <option value="">Seleccionar Cuenta de Ahorro</option>
                            @foreach($savingsAccounts as $savingsAccount)
                                <option value="{{ $savingsAccount->_id }}" {{ isset($transaction) && $transaction->savings_account_id == $savingsAccount->_id ? 'selected' : '' }}>
                                    {{ $savingsAccount->numero_cuenta }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="deposito" {{ old('tipo', isset($transaction) && $transaction->tipo == 'deposito' ? 'selected' : '') }}>Depósito</option>
                            <option value="retiro" {{ old('tipo', isset($transaction) && $transaction->tipo == 'retiro' ? 'selected' : '') }}>Retiro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" step="any" class="form-control" id="monto" name="monto" value="{{ old('monto', isset($transaction) ? $transaction->monto : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion', isset($transaction) ? $transaction->descripcion : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="pendiente" {{ old('estado', isset($transaction) && $transaction->estado == 'pendiente' ? 'selected' : '') }}>Pendiente</option>
                            <option value="completado" {{ old('estado', isset($transaction) && $transaction->estado == 'completado' ? 'selected' : '') }}>Completado</option>
                            <option value="cancelado" {{ old('estado', isset($transaction) && $transaction->estado == 'cancelado' ? 'selected' : '') }}>Cancelado</option>
                        </select>
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
        });
    </script>
@stop
