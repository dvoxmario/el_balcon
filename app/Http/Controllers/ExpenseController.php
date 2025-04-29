<?php

namespace App\Http\Controllers;

use App\Models\expense;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ExpenseController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];
    

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $query = expense::query();


        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);

    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
        try {
			$expense = expense::create([
				'support' => $request['support'],
				'stock_id' => $request['stock_id'],
                'responsible_id' => $request['responsible_id'],
                

			]);


			if (!$expense) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el ingreso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $expense;

        return response()->json($this->response, 200);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expense = expense::find($id);
        if(!$expense)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de ingreso';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $expense;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $expense = expense::find($id);

            if (!$expense) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de ingreso';
                return response()->json($this->response, 400);
            }

			$expense->update([
				'support' => $request['support'],
				'stock_id' => $request['stock_id'],
                'responsible_id' => $request['responsible_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $expense;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $expense = expense::find($id);

        if(!$expense){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el ingreso';
            return response()->json($this->response, 400);
        }

        if($expense->delete()){
            $this->response['data'] = $expense;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el ingreso';
            return response()->json($this->response, 400);
        }
    }
}

