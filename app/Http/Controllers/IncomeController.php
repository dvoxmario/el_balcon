<?php

namespace App\Http\Controllers;

use App\Models\income;
use Database\Seeders\Income as SeedersIncome;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class IncomeController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];


    public function index()
    {
        $query = income::query();


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
			$income = income::create([
				'stock_id' => $request['stock_id'],
                'support' => $request['support'],
				'total_price' => $request['total_price'],
                'supplier_id' => $request['supplier_id'],
                'responsible_id' => $request['responsible_id'],

			]);


			if (!$income) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el ingreso';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $income;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $income = income::find($id);
    if(!$income)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de ingreso';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $income;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $income = income::find($id);

            if (!$income) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de identificacion';
                return response()->json($this->response, 400);
            }

			$income->update([
				'stock_id' => $request['stock_id'],
                'support' => $request['support'],
				'total_price' => $request['total_price'],
                'supplier_id' => $request['supplier_id'],
                'responsible_id' => $request['responsible_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $income;

        return response()->json($this->response, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $income = income::find($id);

        if(!$income){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el ingreso';
            return response()->json($this->response, 400);
        }

        if($income->delete()){
            $this->response['data'] = $income;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el ingreso';
            return response()->json($this->response, 400);
        }
    }
}
