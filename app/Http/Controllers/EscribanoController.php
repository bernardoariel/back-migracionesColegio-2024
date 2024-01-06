<?php

namespace App\Http\Controllers;

use App\Models\Escribano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class EscribanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escribanos = Escribano::all();
        return response()->json(['escribanos' => $escribanos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'matricula' => 'nullable|unique:escribanos,matricula',
            'dni' => 'required|unique:escribanos,dni',
            'cuil' => 'required',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:escribanos,email',
            'condicion_id' => 'required|exists:conditions,id',
            'user_id' => 'required|exists:users,id',
        ];
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'matricula.unique' => 'La matrícula ya está en uso.',
            'matricula.nullable' => 'La matrícula puede ser nula, pero si se proporciona, debe ser única.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.unique' => 'El DNI proporcionado ya está registrado.',
            'cuil.required' => 'El campo CUIL es obligatorio.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'sexo.in' => 'El sexo debe ser Masculino, Femenino o Otro.',
            'direccion.required' => 'La dirección es un campo obligatorio.',
            'telefono.required' => 'El número de teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'condicion_id.required' => 'La condición es un campo obligatorio.',
            'condicion_id.exists' => 'La condición seleccionada no es válida.',
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.'
        ];
        $validatedData = $request->validate($rules, $messages);
        try {
            $escribano = Escribano::create($validatedData);
            return response()->json($escribano, 201);
        } catch (\Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return response()->json([
                'message' => 'Error al crear el escribano.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $escribano = Escribano::findOrFail($id);
        return response()->json($escribano);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Escribano $escribano)
    {
        
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'matricula' => 'nullable|unique:escribanos,matricula,' . $escribano->id,
            'dni' => 'required|unique:escribanos,dni,' . $escribano->id,
            'cuil' => 'nullable',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'nullable',
            'telefono' => 'nullable',
            'email' => 'required|email|unique:escribanos,email,' . $escribano->id,
            'condicion_id' => 'required|exists:conditions,id',
            // 'user_id' => 'required|exists:users,id', // Solo si se permite cambiar el usuario asociado
        ]);

        // Actualizar el escribano con los datos validados
        $escribano->update($validatedData);

        // Devolver el escribano actualizado con un código de estado 200 (OK)
        return response()->json($escribano);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $escribano = Escribano::findOrFail($id);
            $escribano->delete();
    
            return response()->json([
                'message' => 'Escribano eliminado con éxito.'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Escribano no encontrado.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al eliminar el escribano.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }
}
