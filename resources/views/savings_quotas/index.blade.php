@extends('adminlte::page')

@section('title', 'Cuotas de Ahorro')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Cuotas de Ahorro</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('savings_quotas.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
                            Nueva Cuota de Ahorro
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('message') && session('type') == 'success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p>{{ session('message') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php session()->forget(['message', 'type']); @endphp
                        @endif

                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Miembro</th>
                                    <th>Monto</th>
                                    <th>Fecha de la Semana</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savingsQuotas as $savingsQuota)
                                    <tr>
                                        <td>{{ $savingsQuota->member->nombre }} {{ $savingsQuota->member->apellido }}</td>
                                        <td>{{ $savingsQuota->monto }}</td>
                                        <td>{{ $savingsQuota->fecha_semana }}</td>
                                        <td>{{ $savingsQuota->estado }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('savings_quotas.edit', ['savings_quota' => $savingsQuota->_id]) }}"
                                                    class="btn btn-primary btn-sm mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $savingsQuota->_id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Modal para confirmar la eliminación -->
                                                <div class="modal fade" id="deleteModal{{ $savingsQuota->_id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel{{ $savingsQuota->_id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $savingsQuota->_id }}">
                                                                    Confirmar Eliminación</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar esta cuota de ahorro?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <form
                                                                    action="{{ route('savings_quotas.destroy', ['savings_quota' => $savingsQuota->_id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').dataTable();
        });
    </script>
@stop
