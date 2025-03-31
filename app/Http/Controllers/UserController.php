<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];


    public function index()
    {
        $query = User::query();


        // Busqueda basica por nombre o identificador
        // if ($request->has('search') && $request->search !='') {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orwhere('identifiers','like', '%' . $request->search . '%');

        // }
        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }
    public function create()
    {
        //
    }

    public function store(Request $request) //recibe un post , recibe solo body , crea un objeto
    {
        try {
			$user = User::create([
				'name' => $request['name'],
				'identifiers' => $request['identifiers'],
                'password' => $request['password'],
                'identification_type' => $request['identification_type'],

			]);


			if (!$user) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el usuario';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $user;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // consulta un solo objeto, solo get con el id en la url
    {
        $user = User::find($id);
        if(!$user)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $user;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) // post , recibe body y id en la url
    {
        try {

            $user = User::find($id);

            if (!$user) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de identificacion';
                return response()->json($this->response, 400);
            }

			$user->update([
				'name' => $request['name'],
				'value' => $request['value'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $user;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $user = User::find($id);

        if(!$user){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el usuario';
            return response()->json($this->response, 400);
        }

        if($user->delete()){
            $this->response['data'] = $user;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el usuario';
            return response()->json($this->response, 400);
        }
    }
}
