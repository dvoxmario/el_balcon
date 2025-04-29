<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class StockController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];
    public function index()
    {
        $query = stock::query();


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
                $stock = stock::create([
                    'product_id' => $request['product_id'],
                    'amount' => $request['amount'],
                    
                ]);
    
    
                if (!$stock) {
                    $this->response['status'] = 'error';
                    $this->response['message'] = 'no se Creo la cantidad';
                    return response()->json($this->response, 500);
                }
    
            } catch (QueryException $e) {
                return $this->response['message'] = $e->getMessage();
            }
    
            $this->response['data'] = $stock;
    
            return response()->json($this->response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stock = stock::find($id);
        if(!$stock)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el producto en stock';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $stock;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $stock = Stock::find($id);

            if (!$stock) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de stock';
                return response()->json($this->response, 400);
            }

			$stock->update([
				'product_id' => $request['product_id'],
                'amount' => $request['amount'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $stock;

        return response()->json($this->response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = stock::find($id);

        if(!$stock){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el stock';
            return response()->json($this->response, 400);
        }

        if($stock->delete()){
            $this->response['data'] = $stock;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el stock';
            return response()->json($this->response, 400);
        }
    }
}