<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $title_section = 'Propiedades';
        $query = $request->input('search');
        $properties = Property::where('address', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('properties.index', compact('title_section', 'properties'));
    }

    public function manage($id = null)
    {
        if ($id) {

            $property = Property::find($id);
            if (!$property) {
                abort(404);
            }

            $title_section = 'Editar Propiedad';
            return view('properties.manage')
                ->with('title_section', $title_section)
                ->with('property', $property);
        } else {

            $title_section = 'Crear Propiedad';
            return view('properties.manage')
                ->with('title_section', $title_section);
        }
    }

    public function store(Request $request) {
        // Definir las reglas de validación
        $rules = [
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string|max:500', 
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'address.required' => '*La dirección es obligatoria',
            'city.required' => '*La ciudad es obligatoria',
            'price.required' => '*El precio es obligatorio',
            'price.numeric' => '*El precio debe ser un número válido',
            'status.required' => '*El estado es obligatorio',
            'status.in' => '*El estado debe ser Activo o Inactivo',
            'description.max' => '*La descripción no puede exceder los 500 caracteres',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'property' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Crear la nueva propiedad
        $property = Property::create([
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);
    
        // Verificar si la propiedad se creó correctamente
        if ($property) {
            return response()->json([
                'response' => [
                    'property' => true,
                    'message' => 'Éxito al crear la propiedad',
                ],
            ], 201);
        }
    
        return response()->json([
            'response' => [
                'property' => false,
                'message' => 'Error, intente de nuevo',
            ],
        ], 500);
    }

    public function update(Request $request, $id) {
        // Buscar la propiedad por ID
        $property = Property::find($id);
    
        if (!$property) {
            return response()->json(['response' => [
                'property' => false,
                'message' => 'Propiedad no encontrada',
            ]], 404);
        }
    
        // Definir las reglas de validación
        $rules = [
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
            'description' => 'nullable|string|max:500',
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'address.required' => '*La dirección es obligatoria',
            'city.required' => '*La ciudad es obligatoria',
            'price.required' => '*El precio es obligatorio',
            'price.numeric' => '*El precio debe ser un número válido',
            'status.required' => '*El estado es obligatorio',
            'status.in' => '*El estado debe ser Activo o Inactivo',
            'description.max' => '*La descripción no puede exceder los 500 caracteres',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'property' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Actualizar la propiedad
        $property->address = $request->input('address');
        $property->city = $request->input('city');
        $property->price = $request->input('price');
        $property->description = $request->input('description');
        $property->status = $request->input('status');
        $property->save();
    
        return response()->json([
            'response' => [
                'property' => true,
                'message' => 'Éxito al actualizar la propiedad',
            ],
        ], 200);
    }

    public function destroy($id)
    {
        // Encuentra la propiedad o devuelve un error 404 si no se encuentra
        $property = Property::findOrFail($id);

        // Realiza el SoftDelete de la propiedad
        $deleted = $property->delete();

        // Prepara la respuesta basada en el resultado del SoftDelete
        if ($deleted) {
            $response = [
                'property' => true,
                'message' => 'Éxito al eliminar la propiedad',
            ];
        } else {
            $response = [
                'property' => false,
                'message' => 'Error, intente de nuevo',
            ];
        }

        // Retorna la respuesta en formato JSON
        return response()->json($response, 200);
    }
}
