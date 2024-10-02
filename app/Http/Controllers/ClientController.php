<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        $title_section = 'Cliente';
        $query = $request->input('search');
        $clients = Client::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('clients.index', compact('title_section', 'clients'));
    }

    public function manage($id = null)
    {
        if ($id) {

            $client = Client::find($id);
            if (!$client) {
                abort(404);
            }

            $title_section = 'Editar Cliente';
            return view('clients.manage')
                ->with('title_section', $title_section)
                ->with('client', $client);
        } else {

            $title_section = 'Crear Cliente';
            return view('clients.manage')
                ->with('title_section', $title_section);
        }
    }

    public function store(Request $request) {
        // Definir las reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:15',
            'status' => 'nullable|in:0,1', 
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'name.required' => '*El nombre es obligatorio',
            'email.required' => '*El correo electrónico es obligatorio',
            'email.email' => '*El correo electrónico debe ser válido',
            'email.unique' => '*El correo electrónico ya está en uso',
            'phone.max' => '*El número de teléfono no puede exceder los 15 caracteres',
            'status.in' => '*El estado debe ser Activo o Inactivo',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'client' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Crear el nuevo cliente
        $client = Client::create($request->only(['name', 'email', 'phone', 'status']));
    
        // Verificar si el cliente se creó correctamente
        if ($client) {
            return response()->json([
                'response' => [
                    'client' => true,
                    'message' => 'Éxito al crear el cliente',
                ],
            ], 201);
        }
    
        return response()->json([
            'response' => [
                'client' => false,
                'message' => 'Error, intente de nuevo',
            ],
        ], 500);
    }

    public function update(Request $request, $id) {
        // Encontrar el cliente por ID
        $client = Client::find($id);
    
        if (!$client) {
            return response()->json([
                'response' => [
                    'client' => false,
                    'message' => 'Cliente no encontrado.',
                ],
            ], 404);
        }
    
        // Definir las reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:15',
            'status' => 'nullable|in:0,1',
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'name.required' => '*El nombre es obligatorio',
            'email.required' => '*El correo electrónico es obligatorio',
            'email.email' => '*El correo electrónico debe ser válido',
            'email.unique' => '*El correo electrónico ya está en uso',
            'phone.max' => '*El número de teléfono no puede exceder los 15 caracteres',
            'status.in' => '*El estado debe ser Activo o Inactivo',
        ];
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Responder con los errores
            return response()->json([
                'response' => [
                    'errors' => $errors->toArray(),
                    'client' => false,
                    'message' => 'Revise los campos obligatorios',
                ],
            ], 422);
        }
    
        // Actualizar el cliente
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->status = $request->input('status');
        $client->save();
    
        return response()->json([
            'response' => [
                'client' => true,
                'message' => 'Éxito al actualizar el cliente',
            ],
        ], 200);
    }

    public function destroy($id)
    {
        // Encuentra al cliente o devuelve un error 404 si no se encuentra
        $client = Client::findOrFail($id);

        // Realiza el SoftDelete del cliente
        $deleted = $client->delete();

        // Prepara la respuesta basada en el resultado del SoftDelete
        if ($deleted) {
            $response = [
                'client' => true,
                'message' => 'Éxito al eliminar al cliente',
            ];
        } else {
            $response = [
                'client' => false,
                'message' => 'Error, intente de nuevo',
            ];
        }

        // Retorna la respuesta en formato JSON
        return response()->json($response, 200);
    }
}
