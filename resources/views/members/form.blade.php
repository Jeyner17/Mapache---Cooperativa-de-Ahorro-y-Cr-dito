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
                        <span class="text-danger" id="error-nombre" style="display: none;">Solo se permiten letras.</span>
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($member) ? $member->apellido : '') }}" required>
                        <span class="text-danger" id="error-apellido" style="display: none;">Solo se permiten letras.</span>
                        @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($member) ? $member->cedula : '') }}" required>
                        <span class="text-danger" id="error-cedula" style="display: none;">Solo se permiten números y hasta 10 dígitos.</span>
                        @error('cedula')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($member) ? $member->email : '') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="calle" name="direccion[calle]" placeholder="Calle" value="{{ old('direccion.calle', isset($member) ? $member->direccion['calle'] : '') }}" required>
                        @error('direccion.calle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mt-2" id="numero" name="direccion[numero]" placeholder="Número" value="{{ old('direccion.numero', isset($member) ? $member->direccion['numero'] : '') }}" required>
                        @error('direccion.numero')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mt-2" id="calle_secundaria" name="direccion[calle_secundaria]" placeholder="Calle Secundaria" value="{{ old('direccion.calle_secundaria', isset($member) ? $member->direccion['calle_secundaria'] : '') }}">
                        @error('direccion.calle_secundaria')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mt-2" id="ciudad" name="direccion[ciudad]" placeholder="Ciudad" value="{{ old('direccion.ciudad', isset($member) ? $member->direccion['ciudad'] : '') }}" required>
                        @error('direccion.ciudad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono(s)</label>
                        <input type="text" class="form-control" id="telefono" name="telefono[]" placeholder="Teléfono" value="{{ old('telefono.0', isset($member) ? $member->telefono[0] : '') }}" required>
                        <span class="text-danger" id="error-telefono" style="display: none;">Solo se permiten números y hasta 10 dígitos.</span>
                        @error('telefono.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Puedes añadir más números de teléfono con el botón de abajo.</small>
                        <div id="telefonos-extra">
                            @if (isset($member) && count($member->telefono) > 1)
                                @for ($i = 1; $i < count($member->telefono); $i++)
                                    <input type="text" class="form-control mt-2" name="telefono[]" placeholder="Teléfono" value="{{ old('telefono.'.$i, $member->telefono[$i]) }}" required>
                                    @error('telefono.'.$i)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                        @error('estado')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
            function validateInput(input, regex, errorElementId, errorMessage) {
                if (regex.test(input.value)) {
                    $(errorElementId).show().text(errorMessage);
                } else {
                    $(errorElementId).hide();
                }
                input.value = input.value.replace(regex, '');
            }

            function addPhoneValidation(input) {
                $(input).on('input', function() {
                    validateInput(this, /[^0-9]/g, '#error-telefono', 'Solo se permiten números y hasta 10 dígitos.');
                    if (this.value.length > 10) {
                        this.value = this.value.slice(0, 10);
                    }
                });
            }

            $('#agregar-telefono').click(function() {
                var newPhoneInput = $('<input type="text" class="form-control mt-2" name="telefono[]" placeholder="Teléfono" required>');
                $('#telefonos-extra').append(newPhoneInput);
                addPhoneValidation(newPhoneInput);
            });

            $('#nombre').on('input', function() {
                validateInput(this, /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '#error-nombre', 'Solo se permiten letras.');
            });

            $('#apellido').on('input', function() {
                validateInput(this, /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '#error-apellido', 'Solo se permiten letras.');
            });

            $('#cedula').on('input', function() {
                validateInput(this, /[^0-9]/g, '#error-cedula', 'Solo se permiten números y hasta 10 dígitos.');
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            });

            $('input[name="telefono[]"]').each(function() {
                addPhoneValidation(this);
            });
        });
    </script>
@stop
