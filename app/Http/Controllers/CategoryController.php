<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];
    
    public function index()
    {
        $query = category::query();


        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);

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
        try {
			$category = category::create([
				'name' => $request['name'],
				
			]);


			if (!$category) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo la categoria';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $category;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        {
            $category = category::find($id);
            if(!$category)
            {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de categoria';
                return response()->json($this->response, 400);
            }
    
            $this->response['data'] = $category;
            return response()->json($this->response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $category = category::find($id);

            if (!$category) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de categoria';
                return response()->json($this->response, 400);
            }

			$category->update([
				'name' => $request['name'],
				
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $category;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = category::find($id);

        if(!$category){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la categoria';
            return response()->json($this->response, 400);
        }

        if($category->delete()){
            $this->response['data'] = $category;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado la categoria';
            return response()->json($this->response, 400);
        }
    }
}
