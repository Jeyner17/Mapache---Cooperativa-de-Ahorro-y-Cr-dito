@extends('adminlte::page')

@section('title', isset($payment) ? 'Editar Pago' : 'Nuevo Pago')

@section('content_header')
    <h1>{{ isset($payment) ? 'Editar Pago' : 'Nuevo Pago' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($payment))
                <form action="{{ route('payments.update', ['payment' => $payment->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('payments.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="loan_id">Préstamo</label>
                        <select class="form-control" id="loan_id" name="loan_id" required>
                            <option value="">Seleccionar Préstamo</option>
                            @foreach($loans as $loan)
                                <option value="{{ $loan->_id }}" {{ isset($payment) && $payment->loan_id == $loan->_id ? 'selected' : '' }}>
                                    {{ $loan->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" step="any" class="form-control" id="monto" name="monto" value="{{ old('monto', isset($payment) ? $payment->monto : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="abono" {{ old('tipo', isset($payment) && $payment->tipo == 'abono' ? 'selected' : '') }}>Abono</option>
                            <option value="cargo" {{ old('tipo', isset($payment) && $payment->tipo == 'cargo' ? 'selected' : '') }}>Cargo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="pendiente" {{ old('estado', isset($payment) && $payment->estado == 'pendiente' ? 'selected' : '') }}>Pendiente</option>
                            <option value="completado" {{ old('estado', isset($payment) && $payment->estado == 'completado' ? 'selected' : '') }}>Completado</option>
                            <option value="cancelado" {{ old('estado', isset($payment) && $payment->estado == 'cancelado' ? 'selected' : '') }}>Cancelado</option>
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
