<?php

namespace App\Http\Controllers;

use App\Models\income_detail;
use App\Models\IncomeDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class IncomeDetailController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];

    public function index()
     {
        $query = IncomeDetail::query();

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
			$income_detail = IncomeDetail::create([
				'amount' => $request['amount'],
                'price' => $request[ 'price'],
				'income_id' => $request['income_id'],
                'product_id' => $request ['product_id']
                

			]);


			if (!$income_detail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el detalle del ingreso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $income_detail;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $income_detail = IncomeDetail::find($id);
        if(!$income_detail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de ingreso de detalle';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $income_detail;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(income_detail $income_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $income_detail = IncomeDetail::find($id);

            if (!$income_detail) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de ingreso detallado';
                return response()->json($this->response, 400);
            }

			$income_detail->update([
				'price' => $request['responsible'],
				'identifiers' => $request['price'],
                'income_id' => $request['income_id'],
                'product_id' => $request['product_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $income_detail;

        return response()->json($this->response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $income_detail = IncomeDetail::find($id);

        if(!$income_detail){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el ingreso de detalle';
            return response()->json($this->response, 400);
        }

        if($income_detail->delete()){
            $this->response['data'] = $income_detail;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el ingreso de detalle';
            return response()->json($this->response, 400);
        }
    }
}
