@extends('adminlte::page')

@section('title', 'Cuentas de Ahorro')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Cuentas de Ahorro</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('savings_accounts.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
                            Nueva Cuenta de Ahorro
                        </a>
                    </div>
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
                                    <th>Número de Cuenta</th>
                                    <th>Saldo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savingsAccounts as $account)
                                    <tr>
                                        <td>{{ $account->member->nombre }}</td>
                                        <td>{{ $account->numero_cuenta }}</td>
                                        <td>{{ $account->saldo }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('savings_accounts.edit', $account->_id) }}" class="btn btn-primary btn-sm mr-3">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $account->_id }}">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                                <!-- Modal para confirmar la eliminación -->
                                                <div class="modal fade" id="deleteModal{{ $account->_id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $account->_id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $account->_id }}">
                                                                    Confirmar Eliminación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar esta cuenta de ahorro?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('savings_accounts.destroy', $account->_id) }}" method="POST">
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
