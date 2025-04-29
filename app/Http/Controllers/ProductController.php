<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];

    public function index()
    {
        $query = product::query();




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
       {
        try {
			$product = product ::create([
				'name' => $request['name'],
				'value' => $request['value'],
                'category_id' => $request['category_id'],
                
			]);


			if (!$product) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el producto';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $product;

        return response()->json($this->response, 200);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

  {
        $product = product::find($id);
        if(!$product)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de producto';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $product;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $product = product::find($id);

            if (!$product) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de producto';
                return response()->json($this->response, 400);
            }

			$product->update([
				'name' => $request['name'],
				'value' => $request['value'],
                'category_id' => $request['category_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $product;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = product::find($id);

        if(!$product){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el product';
            return response()->json($this->response, 400);
        }

        if($product->delete()){
            $this->response['data'] = $product;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el producto';
            return response()->json($this->response, 400);
        }
    }
}
