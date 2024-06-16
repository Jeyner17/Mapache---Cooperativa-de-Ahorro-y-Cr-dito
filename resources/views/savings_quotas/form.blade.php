@extends('adminlte::page')

@section('title', isset($savingsQuota) ? 'Editar Cuota de Ahorro' : 'Nueva Cuota de Ahorro')

@section('content_header')
    <h1>{{ isset($savingsQuota) ? 'Editar Cuota de Ahorro' : 'Nueva Cuota de Ahorro' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($savingsQuota))
                <form action="{{ route('savings_quotas.update', ['savings_quota' => $savingsQuota->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('savings_quotas.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="member_id">Miembro</label>
                        <select class="form-control" id="member_id" name="member_id" required>
                            <option value="">Seleccionar Miembro</option>
                            @foreach($members as $member)
                                <option value="{{ $member->_id }}" {{ isset($savingsQuota) && $savingsQuota->member_id == $member->_id ? 'selected' : '' }}>
                                    {{ $member->nombre }} {{ $member->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input type="number" step="any" class="form-control" id="monto" name="monto" value="{{ old('monto', isset($savingsQuota) ? $savingsQuota->monto : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_semana">Fecha de la Semana</label>
                        <input type="date" class="form-control" id="fecha_semana" name="fecha_semana" value="{{ old('fecha_semana', isset($savingsQuota) ? $savingsQuota->fecha_semana : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="pendiente" {{ old('estado', isset($savingsQuota) && $savingsQuota->estado == 'pendiente' ? 'selected' : '') }}>Pendiente</option>
                            <option value="pagado" {{ old('estado', isset($savingsQuota) && $savingsQuota->estado == 'pagado' ? 'selected' : '') }}>Pagado</option>
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
            // Aquí puedes agregar cualquier script adicional necesario para el formulario
        });
    </script>
@stop
