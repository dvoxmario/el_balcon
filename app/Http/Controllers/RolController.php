<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RolController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rol::query();

        // Filtro opcional de búsqueda
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $this->response['data'] = $query->with('userRols', 'rolPermisions')->get();//se cargan las relaciones 
        return response()->json($this->response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            
            $rol = Rol::create($validated);

            $this->response['data'] = $rol;
            return response()->json($this->response, 201); // Código 201 para recursos creados
        } catch (QueryException $e) {
            // En caso de error en la base de datos
            $this->response['status'] = 'error';
            $this->response['message'] = 'Error al crear el rol: ' . $e->getMessage();
            return response()->json($this->response, 500); // Código 500 para errores internos
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $rol = Rol::with('userRols', 'rolPermissions')->findOrFail($id); // se carga relaciones

            $this->response['data'] = $rol;
            return response()->json($this->response, 200);
        } catch (\Exception $e) {
            
            $this->response['status'] = 'error';
            $this->response['message'] = 'Rol no encontrado';
            return response()->json($this->response, 404); // Código 404 para no encontrado
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de la entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $rol = Rol::findOrFail($id); // Lanza una excepción si no se encuentra el rol
            $rol->update($validated);
            $this->response['data']= $rol;
            return response()->json($this->response,200);//codigo 200 para ser actualizado


        } catch (QueryException $e) {
            // En caso de error en la base de datos
            $this->response['status'] = 'error';
            $this->response['message'] = 'Error al actualizar el rol: ' . $e->getMessage();
            return response()->json($this->response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $rol = Rol::findOrFail($id); // Lanza una excepción si no se encuentra el rol

            // Eliminar el rol
            $rol->delete();

            $this->response['data'] = $rol;
            return response()->json($this->response, 200);
        } catch (\Exception $e) {
            // En caso de error en la base de datos o si no se encuentra el rol
            $this->response['status'] = 'error';
            $this->response['message'] = 'Error al eliminar el rol: ' . $e->getMessage();
            return response()->json($this->response, 500); // Código 500 para error interno
        }
    }
}
