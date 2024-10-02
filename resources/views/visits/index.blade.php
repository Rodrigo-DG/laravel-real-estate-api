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
                            <form method="GET" action="{{ route('index.visits') }}">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request()->input('search') }}">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-8 text-sm-end">
                        <a href="{{ route('manage.visits') }}" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">
                            <i class="mdi mdi-plus me-1"></i>Crear visita
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle"># ID</th>
                                <th class="align-middle">Cliente</th>
                                <th class="align-middle">Propiedad</th>
                                <th class="align-middle">Cuidad</th>
                                <th class="align-middle">Fecha de visita</th>
                                <th class="align-middle">ESTADO</th>
                                <th class="align-middle">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visits as $visit)
                                <tr>
                                    <td class="tds"><a href="javascript: void(0);" class="text-body fw-bold">{{$visit->id}}</a></td>
                                    <td class="tdl">{{$visit->client->name}}</td>
                                    <td>{{$visit->property->address}}</td>
                                    <td>{{$visit->property->city}}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d-m-Y') }}</td>
                                    <td class="tdl">
                                        @if($visit->status == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @elseif($visit->status == 0)
                                            <span class="badge bg-danger">Inactivo</span>
                                        @else
                                            <span class="badge bg-secondary">Desconocido</span>
                                        @endif
                                    </td>
                                    <td class="tds">
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('manage.visits', $visit->id) }}" class="text-secondary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="text-danger deleteVisitModal" data-visit-id="{{$visit->id}}" data-bs-toggle="modal" data-bs-target="#deleteVisitModal">
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
                    {{ $visits->appends(['search' => request()->input('search')])->links() }}
                </div>

                <div>
                    Mostrando {{ $visits->firstItem() ?? 0 }} a {{ $visits->lastItem() ?? 0 }} de {{ $visits->total() }} resultados.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de eliminar propiedad -->
    <div class="modal fade" id="deleteVisitModal" tabindex="-1" aria-labelledby="deleteVisitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="deleteVisitModalLabel">¿Desea eliminar la visita?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar la visita?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</body>
@include('visits.script-visit')
@endsection