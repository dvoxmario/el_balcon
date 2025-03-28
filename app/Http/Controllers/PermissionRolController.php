<?php

namespace App\Http\Controllers;

use App\Models\PermissionRol;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PermissionRolController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'date' => []

    ];

    public function index(Request $request)
    {
        $query = PermissionRol::query();
        // Busqueda si es necesario 
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('rol', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('permisions', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $this->response['data'] = $query->with('rol', 'permisions')->get();
        return response()->json($this->response, 200);

    }

    public function store(Request $request)
    {
        //validacion 
        $validated = $request->validate([
            'rol_id' => 'required|exists:rols,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        try{
            $permissionRol = PermissionRol::create($validated);
            $this->response['data'] = $permissionRol;
            return response()->json($this->response,201); // codigo 201 creado 


        }catch (QueryException $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Database error: ' .$e->getMessage();
            return response()->json($this->response, 500); // error en la base de datos 
        }

     }

    /**
     * Display the specified resource.
     */
    public function show($id)
    
    {
        try {
            $permissionRol = PermissionRol::with('rol', 'permisions')->findOrFail($id);  // Cargar relaciones
            $this->response['data'] = $permissionRol;
            return response()->json($this->response, 200);
        } catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'PermissionRol not found';
            return response()->json($this->response, 404);  // Código 404 si no se encuentra el permiso
        }
    }

    
    public function update(Request $request, $id)
    {
        // Validación
        $validated = $request->validate([
            'rol_id' => 'required|exists:rols,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        try {
            $permissionRol = PermissionRol::findOrFail($id);
            $permissionRol->update($validated);
            $this->response['data'] = $permissionRol;
            return response()->json($this->response, 200);  // Código 200 para actualizado
        } catch (QueryException $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Database error: ' . $e->getMessage();
            return response()->json($this->response, 500);  // Error en la base de datos
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $permissionRol = PermissionRol::findOrFail($id);
            $permissionRol->delete();
            $this->response['data'] = $permissionRol;
            return response()->json($this->response, 200);  // Código 200 para eliminado
        } catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'PermissionRol not found or deletion failed';
            return response()->json($this->response, 404);//error si no se encuentra el permiso
        } 
    }
}
