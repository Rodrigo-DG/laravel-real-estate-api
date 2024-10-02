<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Visit;
use App\Models\Property;
use App\Models\Client;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $title_section = 'Visitas';
        $query = $request->input('search');

        // Realiza la consulta y aplica el filtro
        $visits = Visit::with(['client', 'property'])
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('client', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })->orWhereHas('property', function ($q) use ($query) {
                    $q->where('address', 'LIKE', "%{$query}%");
                });
            })
            ->paginate(5);

        return view('visits.index', compact('title_section', 'visits'));
    }

    public function manage($id = null)
    {
        // Obtener todos los clientes
        $clients = Client::all();

        // Obtener todas las propiedades
        $properties = Property::all();

        if ($id) {
            $visit = Visit::find($id);
            if (!$visit) {
                abort(404);
            }

            $title_section = 'Editar visita';
            return view('visits.manage')
                ->with('title_section', $title_section)
                ->with('visit', $visit)
                ->with('clients', $clients) 
                ->with('properties', $properties);
        } else {
            $title_section = 'Crear visita';
            return view('visits.manage')
                ->with('title_section', $title_section)
                ->with('clients', $clients)
                ->with('properties', $properties);
        }
    }

    public function store(Request $request) {
        // Definir las reglas de validación
        $rules = [
            'client_id' => 'required',
            'property_id' => 'required',
            'visit_date' => 'required|date',
            'status' => 'required|in:0,1',
            'comments' => 'nullable|string|max:500',
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'client_id.required' => '*El cliente es obligatorio',
            'property_id.required' => '*La propiedad es obligatoria',
            'visit_date.required' => '*La fecha de la visita es obligatoria',
            'visit_date.date' => '*La fecha de la visita debe ser válida',
            'status.required' => '*El estado es obligatorio',
            'status.in' => '*El estado debe ser Activo o Inactivo',
            'comments.max' => '*Los comentarios no pueden exceder los 500 caracteres',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'visit' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Crear la nueva visita
        $visit = Visit::create([
            'client_id' => $request->input('client_id'),
            'property_id' => $request->input('property_id'),
            'visit_date' => $request->input('visit_date'),
            'status' => $request->input('status'),
            'comments' => $request->input('comments'),
        ]);
    
        // Verificar si la visita se creó correctamente
        if ($visit) {
            return response()->json([
                'response' => [
                    'visit' => true,
                    'message' => 'Éxito al crear la visita',
                ],
            ], 201);
        }
    
        return response()->json([
            'response' => [
                'visit' => false,
                'message' => 'Error, intente de nuevo',
            ],
        ], 500);
    }

    public function update(Request $request, $id) {

        // Buscar la visita por ID
        $visit = Visit::find($id);
        if (!$visit) {
            return response()->json(['message' => 'Visita no encontrada'], 404);
        }
    
        // Definir las reglas de validación
        $rules = [
            'client_id' => 'required',
            'property_id' => 'required',
            'visit_date' => 'required|date',
            'status' => 'required|in:0,1',
            'comments' => 'nullable|string|max:500',
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'client_id.required' => '*El cliente es obligatorio',
            'property_id.required' => '*La propiedad es obligatoria',
            'visit_date.required' => '*La fecha de la visita es obligatoria',
            'visit_date.date' => '*La fecha de la visita debe ser válida',
            'status.required' => '*El estado es obligatorio',
            'status.in' => '*El estado debe ser Activo o Inactivo',
            'comments.max' => '*Los comentarios no pueden exceder los 500 caracteres',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'visit' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Actualizar la visita
        $visit->client_id = $request->input('client_id');
        $visit->property_id = $request->input('property_id');
        $visit->visit_date = $request->input('visit_date');
        $visit->status = $request->input('status');
        $visit->comments = $request->input('comments');
        $visit->save();
    
        return response()->json([
            'response' => [
                'visit' => true,
                'message' => 'Éxito al actualizar la visita',
            ],
        ], 200);
    }

    public function destroy($id)
    {
        // Encuentra la visita o devuelve un error 404 si no se encuentra
        $visit = Visit::findOrFail($id);

        // Realiza el SoftDelete de la visita
        $deleted = $visit->delete();

        // Prepara la respuesta basada en el resultado del SoftDelete
        if ($deleted) {
            $response = [
                'visit' => true,
                'message' => 'Éxito al eliminar la visita',
            ];
        } else {
            $response = [
                'visit' => false,
                'message' => 'Error, intente de nuevo',
            ];
        }

        // Retorna la respuesta en formato JSON
        return response()->json($response, 200);
    }
}
