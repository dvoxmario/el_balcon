<?php

namespace App\Http\Controllers;

use App\Models\expenseDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ExpenseDetailController extends Controller
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
        $query = expenseDetail::query();


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
			$expenseDetail = expenseDetail::create([
				'amount' => $request['amount'],
				'expense_id' => $request['expense_id'],
                'product_id' => $request['product_id'],


			]);


			if (!$expenseDetail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el detalle de egreso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $expenseDetail;

        return response()->json($this->response, 200);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expenseDetail = expenseDetail::find($id);
        if(!$expenseDetail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el detalle de egreso';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $expenseDetail;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expenseDetail $expenseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $expenseDetail = expenseDetail::find($id);

            if (!$expenseDetail) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el detalle de egreso';
                return response()->json($this->response, 400);
            }

			$expenseDetail->update([
				'amount' => $request['amount'],
				'expense_id' => $request['expense_id'],
                'product_id' => $request['product_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $expenseDetail;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $expenseDetail = expenseDetail::find($id);

        if(!$expenseDetail){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el detalle de egreso';
            return response()->json($this->response, 400);
        }

        if($expenseDetail->delete()){
            $this->response['data'] = $expenseDetail;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el detalle de egreso';
            return response()->json($this->response, 400);
        }
    }
}

