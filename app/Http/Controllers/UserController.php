<?php

namespace App\Http\Controllers;


use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => null,
        'data' => []

    ];


    public function index(Request $request)
    {
        $query = User::query();


        // Busqueda basica por nombre o identificador
        if ($request->has('search') && $request->search !='') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orwhere('identifiers','like', '%' . $request->search . '%');

        }
        $this->response['data'] = $query->whit('identificationTypes','userRols','reservations')->get();

        return response()->json($this->response, 200);
    }
    
    public function store(Request $request)
    {
        //vallidacion
      $validated = $request->validate([

        'name' => 'required|string|max:255',
        'identifiers' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'identification_type_id' => 'required|exists:identification_types,id',

        ]);

        try {
        //crear un nuevo usuario
        $user = User::create($validated);

        //hash de la contraseña antes de guardar
        $user->password = bcrypt($request->password);
        $user->save();

        $this->response['data']= $user;
        return response()->json($this->response, 201); //codigo de creado 

        }

        catch (QueryException $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'Database error: ' . $e->getMessage();
            return response()->json($this->response, 500);

         }

      
    }

    public function show($id)
    {
        try{
            $user = User::with('identificationTypes', 'userRols', 'reservations')->findOrFail($id);
            $this->response['data'] = $user;
            return response()->json($this->response, 200);

        } 
        catch (\Exception $e) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'user not found';
            return response()->json($this->response, 404); //codigo si no se encuentra el usuario

          }

     }

     public function update(Request $request, $id)
     {
        //validacion
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identifiers' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'identification_type_id' => 'required|exists:identification_types,id',

        ]);

            try{
                 $user = User::findOrFail($id);

                //Actualizar la informacion del usuario
                $user->update($validated);
            

                // si se proporciona nueva contraseña, se actualiza
                if($request->has('password')) {
                $user->password = bcrypt($request->password);

                }

                $user->save();

                $this->response['data'] = $user;
                return response()->json($this->response, 200); //codigo 200 para actualizado

            }

            catch(QueryException $e) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'Database error: ' . $e->getMessage();
                return response()->json($this->response, 500); //error en la base de datos 

            }
    }    

    public function destroy($id)
    {
        try{ 
            $user = User::findOrFail($id);
            $user->delete();

            $this->response['data']=$user;
            return response()->json($this->response, 200); //codigo 200 eliminado
        }   
        catch (\Exception $e) {

        $this->response['status'] = 'error';
        $this->response['message'] = 'User not found or deletion failed';
        return response()->json($this->response,404); //error si no se encuentra el usuario

         }
    }
}
        

        


    
    

