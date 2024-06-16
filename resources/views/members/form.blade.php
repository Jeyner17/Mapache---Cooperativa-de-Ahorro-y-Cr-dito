@extends('adminlte::page')

@section('title', isset($member) ? 'Editar Miembro' : 'Nuevo Miembro')

@section('content_header')
    <h1>{{ isset($member) ? 'Editar Miembro' : 'Nuevo Miembro' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($member))
                <form action="{{ route('members.update', ['member' => $member->_id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('members.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($member) ? $member->nombre : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($member) ? $member->apellido : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($member) ? $member->cedula : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($member) ? $member->email : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="calle" name="direccion[calle]" placeholder="Calle" value="{{ old('direccion.calle', isset($member) ? $member->direccion['calle'] : '') }}" required>
                        <input type="text" class="form-control mt-2" id="numero" name="direccion[numero]" placeholder="Número" value="{{ old('direccion.numero', isset($member) ? $member->direccion['numero'] : '') }}" required>
                        <input type="text" class="form-control mt-2" id="calle_secundaria" name="direccion[calle_secundaria]" placeholder="Calle Secundaria" value="{{ old('direccion.calle_secundaria', isset($member) ? $member->direccion['calle_secundaria'] : '') }}">
                        <input type="text" class="form-control mt-2" id="ciudad" name="direccion[ciudad]" placeholder="Ciudad" value="{{ old('direccion.ciudad', isset($member) ? $member->direccion['ciudad'] : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono(s)</label>
                        <input type="text" class="form-control" id="telefono" name="telefono[]" placeholder="Teléfono" value="{{ old('telefono.0', isset($member) ? $member->telefono[0] : '') }}" required>
                        <small class="form-text text-muted">Puedes añadir más números de teléfono con el botón de abajo.</small>
                        <div id="telefonos-extra">
                            @if (isset($member) && count($member->telefono) > 1)
                                @for ($i = 1; $i < count($member->telefono); $i++)
                                    <input type="text" class="form-control mt-2" name="telefono[]" placeholder="Teléfono" value="{{ old('telefono.'.$i, $member->telefono[$i]) }}" required>
                                @endfor
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="agregar-telefono">Agregar Teléfono</button>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="activo" {{ old('estado', isset($member) && $member->estado == 'activo' ? 'selected' : '') }}>Activo</option>
                            <option value="inactivo" {{ old('estado', isset($member) && $member->estado == 'inactivo' ? 'selected' : '') }}>Inactivo</option>
                            <option value="suspendido" {{ old('estado', isset($member) && $member->estado == 'suspendido' ? 'selected' : '') }}>Suspendido</option>
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
            $('#agregar-telefono').click(function() {
                $('#telefonos-extra').append('<input type="text" class="form-control mt-2" name="telefono[]" placeholder="Teléfono" required>');
            });
        });
    </script>
@stop
