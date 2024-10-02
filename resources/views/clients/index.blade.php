@extends('layouts.app')

@section('content')
<body class="index-view">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ $title_section }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <form method="GET" action="{{ route('index.clients') }}">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request()->input('search') }}">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-8 text-sm-end">
                        <a href="{{ route('manage.clients') }}" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i>Crear cliente
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle"># ID</th>
                                <th class="align-middle">NOMBRE</th>
                                <th class="align-middle">EMAIL</th>
                                <th class="align-middle">TELEFONO</th>
                                <th class="align-middle">ESTADO</th>
                                <th class="align-middle">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td class="tds"><a href="javascript: void(0);" class="text-body fw-bold">{{$client->id}}</a></td>
                                    <td class="tdl">{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td class="tdl">
                                        @if($client->status == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @elseif($client->status == 0)
                                            <span class="badge bg-danger">Inactivo</span>
                                        @else
                                            <span class="badge bg-secondary">Desconocido</span>
                                        @endif
                                    </td>
                                    <td class="tds">
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('manage.clients', $client->id) }}" class="text-secondary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="text-danger deleteClientModal" data-client-id="{{$client->id}}" data-client-name="{{$client->name}}" data-bs-toggle="modal" data-bs-target="#deleteClientModal">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $clients->appends(['search' => request()->input('search')])->links() }}
                </div>

                <div>
                    Mostrando {{ $clients->firstItem() ?? 0 }} a {{ $clients->lastItem() ?? 0 }} de {{ $clients->total() }} resultados.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de eliminar cliente -->
    <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="deleteClientModalLabel">¿Desea eliminar al cliente?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar al cliente?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</body>
@include('clients.script-client')
@endsection