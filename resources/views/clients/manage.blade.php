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

                <form id="clientForm">

                    <input type="hidden" name="client_id" id="client_id" value="{{ isset($client) ? $client['id'] : '' }}">

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label"><strong>Nombre del cliente</strong></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($client['name']) ? $client['name'] : '') }}" placeholder="Ingrese el nombre del cliente...">
                            <span id="error-name" class="text-danger"></span>
                        </div>

                        <div class="col mb-3">
                            <label for="email" class="form-label"><strong>Email</strong></label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email', isset($client['email']) ? $client['email'] : '') }}" placeholder="Ingrese el Email del cliente...">
                            <span id="error-email" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="phone" class="form-label"><strong>Teléfono</strong></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', isset($client['phone']) ? $client['phone'] : '') }}" placeholder="Ingrese el teléfono del cliente...">
                            <span id="error-phone" class="text-danger"></span>
                        </div>

                        <div class="col mb-3">
                            <label for="status" class="form-label"><strong>Estado</strong></label>
                            <select class="form-control form-select" name="status" id="status">
                                <option value="1" {{ old('status', isset($client) ? $client['status'] : '') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('status', isset($client) ? $client['status'] : '') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <span id="error-status" class="text-danger"></span>
                        </div>
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
@include('clients.script-client')
@endsection
