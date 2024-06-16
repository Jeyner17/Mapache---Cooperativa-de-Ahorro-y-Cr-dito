@extends('adminlte::page')

@section('title', isset($loan) ? 'Editar Préstamo' : 'Nuevo Préstamo')

@section('content_header')
    <h1>{{ isset($loan) ? 'Editar Préstamo' : 'Nuevo Préstamo' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($loan))
                <form action="{{ route('loans.update', ['loan' => $loan->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('loans.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="member_id">Miembro</label>
                        <select class="form-control" id="member_id" name="member_id" required>
                            <option value="">Seleccionar Miembro</option>
                            @foreach($members as $member)
                                <option value="{{ $member->_id }}" {{ isset($loan) && $loan->member_id == $member->_id ? 'selected' : '' }}>
                                    {{ $member->nombre }} {{ $member->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" step="any" class="form-control" id="monto" name="monto" value="{{ old('monto', isset($loan) ? $loan->monto : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="interes">Interés (%)</label>
                        <input type="number" step="any" class="form-control" id="interes" name="interes" value="{{ old('interes', isset($loan) ? $loan->interes : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="plazo">Plazo (meses)</label>
                        <input type="number" class="form-control" id="plazo" name="plazo" value="{{ old('plazo', isset($loan) ? $loan->plazo : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="activo" {{ old('estado', isset($loan) && $loan->estado == 'activo' ? 'selected' : '') }}>Activo</option>
                            <option value="inactivo" {{ old('estado', isset($loan) && $loan->estado == 'inactivo' ? 'selected' : '') }}>Inactivo</option>
                            <option value="cancelado" {{ old('estado', isset($loan) && $loan->estado == 'cancelado' ? 'selected' : '') }}>Cancelado</option>
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
