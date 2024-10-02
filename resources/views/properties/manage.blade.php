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

                <form id="propertyForm">

                    <input type="hidden" name="property_id" id="property_id" value="{{ isset($property) ? $property['id'] : '' }}">

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="address" class="form-label"><strong>Direción</strong></label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', isset($property['address']) ? $property['address'] : '') }}" placeholder="Ingrese la dirección de la propiedad...">
                            <span id="error-address" class="text-danger"></span>
                        </div>

                        <div class="col mb-3">
                            <label for="city" class="form-label"><strong>Ciudad</strong></label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', isset($property['city']) ? $property['city'] : '') }}" placeholder="Ingrese la ciudad de la propiedad...">
                            <span id="error-city" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col mb-3">
                            <label for="price" class="form-label"><strong>Precio</strong></label>
                            <input type="number" class="form-control" name="price" id="price" value="{{ old('price', isset($property['price']) ? $property['price'] : '') }}" placeholder="Ingrese el precio de la propiedad...">
                            <span id="error-price" class="text-danger"></span>
                        </div>

                        <div class="col mb-3">
                            <label for="status" class="form-label"><strong>Estado</strong></label>
                            <select class="form-control form-select" name="status" id="status">
                                <option value="1" {{ old('status', isset($property) ? $property['status'] : '') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('status', isset($property) ? $property['status'] : '') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label"><strong>Descripción </label>
                        <textarea class="form-control" name="description" id="description" rows="2">{{ old('description', isset($property['description']) ? $property['description'] : '') }}</textarea>
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
@include('properties.script-property')
@endsection
