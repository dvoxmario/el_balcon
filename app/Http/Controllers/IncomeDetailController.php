<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\income_detail;
use App\Models\IncomeDetail;
=======
use App\Models\IncomeDetail;
use Illuminate\Database\QueryException;
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class IncomeDetailDetailController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];

<<<<<<< HEAD
    public function index()
     {
        $query = IncomeDetail::query();

        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }
=======

    public function index()
    {
        $query = IncomeDetail::query();
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
<<<<<<< HEAD
			$income_detail = IncomeDetail::create([
				'amount' => $request['amount'],
                'price' => $request[ 'price'],
				'income_id' => $request['income_id'],
                'product_id' => $request ['product_id']
                
=======
			$IncomeDetail = IncomeDetail::create([
				'amount' => $request['amount'],
                'price' => $request['price'],
                'income_id' => $request['income_id'],
                'product_id' => $request['product_id'],
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80

			]);


<<<<<<< HEAD
			if (!$income_detail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el detalle del ingreso';
=======
			if (!$IncomeDetail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el  detalle de ingreso';
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

<<<<<<< HEAD
        $this->response['data'] = $income_detail;
=======
        $this->response['data'] = $IncomeDetail;
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
<<<<<<< HEAD
        $income_detail = IncomeDetail::find($id);
        if(!$income_detail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de ingreso de detalle';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $income_detail;
=======
        $IncomeDetail = IncomeDetail::find($id);
    if(!$IncomeDetail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el detalle de ingreso';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $IncomeDetail;
>>>>>>> ca326f29e5e41228c0443081214cebdfb2bdfc80
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeDetail $IncomeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $IncomeDetail = IncomeDetail::find($id);

            if (!$IncomeDetail) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el detalle de ingreso';
                return response()->json($this->response, 400);
            }

			$IncomeDetail->update([
				'amount' => $request['amount'],
                'price' => $request['price'],
                'income_id' => $request['income_id'],
                'product_id' => $request['product_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $IncomeDetail;

        return response()->json($this->response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $IncomeDetail = IncomeDetail::find($id);

        if(!$IncomeDetail){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el detalle de ingreso';
            return response()->json($this->response, 400);
        }

        if($IncomeDetail->delete()){
            $this->response['data'] = $IncomeDetail;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el detalle de ingreso';
            return response()->json($this->response, 400);
        }
    }
}
