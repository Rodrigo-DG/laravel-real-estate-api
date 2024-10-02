@extends('layouts.app')

@section('content')
<body class="manage-view">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ $title_section }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                <form id="visitForm">

                    <input type="hidden" name="visit_id" id="visit_id" value="{{ isset($visit) ? $visit['id'] : '' }}">

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="client_id" class="form-label"><strong>Cliente</strong></label>
                            <select class="form-control form-select" name="client_id" id="client_id">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}" {{ isset($visit) && $client->id == $visit->client_id ? 'selected' : '' }}>{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="property_id" class="form-label"><strong>Propiedad</strong></label>
                            <select class="form-control form-select" name="property_id" id="property_id">
                                @foreach($properties as $property)
                                    <option value="{{$property->id}}" {{ isset($visit) && $property->id == $visit->property_id ? 'selected' : '' }}>{{$property->address}} - {{$property->city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="visit_date" class="form-label"><strong>Fecha de la visita</strong></label>
                            <input class="form-control" type="date" name="visit_date" id="visit_date" value="{{ old('visit_date', isset($visit['visit_date']) ? $visit['visit_date'] : '') }}">
                            <span id="error-visit_date" class="text-danger"></span>
                        </div>

                        <div class="col mb-3">
                            <label for="status" class="form-label"><strong>Estado</strong></label>
                            <select class="form-control form-select" name="status" id="status">
                                <option value="1" {{ old('status', isset($visit) ? $visit['status'] : '') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('status', isset($visit) ? $visit['status'] : '') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comments" class="form-label"><strong>Comentarios</label>
                        <textarea class="form-control" name="comments" id="comments" rows="2">{{ old('comments', isset($visit['comments']) ? $visit['comments'] : '') }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-lg waves-effect waves-light">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</body>
@include('visits.script-visit')
@endsection
