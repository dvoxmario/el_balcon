<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []
    ];

    /**
     * Display a listing of the permissions.
     */
    public function index()
    {
        $query = Permission::query();
        // Obtener todos los permisos
        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);  // Código 200 para éxito
    }

    /**
     * Store a newly created permission.
     */
    public function store(Request $request)
    {
        try {
			$permission = Permission::create([
				'name' => $request['name'],
			

			]);


			if (!$permission) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el permiso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $permission;

        return response()->json($this->response, 200);
    }
    /**
     * Assign a permission to a role.
     */
    public function assignPermissionToRole(Request $request)
    {
        // Validar la entrada
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',  // Asegura que el rol existe
            'permission_id' => 'required|exists:permissions,id',  // Asegura que el permiso existe
        ]);

        try {
            // Obtener el rol y el permiso
            $role = Rol::findOrFail($validated['role_id']);
            $permission = Permission::findOrFail($validated['permission_id']);

            // Asignar el permiso al rol
            if (!$role->permissions->contains($permission)) {
                $role->permissions()->attach($permission);
                $this->response['message'] = 'Permission assigned to role successfully';
            } else {
                $this->response['message'] = 'Permission already assigned to this role';
            }

            return response()->json($this->response, 200);  // Código 200 para éxito
        } catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Error assigning permission: ' . $e->getMessage();
            return response()->json($this->response, 500);  // Código 500 para error interno
        }
    }

    /**
     * Remove a permission from a role.
     */
    public function removePermissionFromRole(Request $request)
    {
        // Validar la entrada
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',  // Asegura que el rol existe
            'permission_id' => 'required|exists:permissions,id',  // Asegura que el permiso existe
        ]);

        try {
            // Obtener el rol y el permiso
            $role = Rol::findOrFail($validated['role_id']);
            $permission = Permission::findOrFail($validated['permission_id']);

            // Eliminar el permiso del rol
            if ($role->permissions->contains($permission)) {
                $role->permissions()->detach($permission);
                $this->response['message'] = 'Permission removed from role successfully';
            } else {
                $this->response['message'] = 'Permission not assigned to this role';
            }

            return response()->json($this->response, 200);  // Código 200 para éxito
        } catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Error removing permission: ' . $e->getMessage();
            return response()->json($this->response, 500);  // Código 500 para error interno
        }
    }

    /**
     * Display the roles associated with a permission.
     */
    public function showRoles($permissionId)
    {
        try {
            $permission = Permission::findOrFail($permissionId);

            // Obtener los roles asociados con el permiso
            $this->response['data'] = $permission->roles;
            return response()->json($this->response, 200);  // Código 200 para éxito
        } catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Permission not found';
            return response()->json($this->response, 404);  // Código 404 si no se encuentra el permiso
        }
    }
}                                                      
