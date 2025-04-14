<?php

namespace App\Http\Controllers;

use App\Models\Payment_method;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PaymentMethodController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []
    ];
    public function index()
    {
        $query = PaymentMethod::query();




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
			$paymentMethod = PaymentMethod::create([
				'name' => $request['name'],
				'relation' => $request['relation'],
                'type' => $request['type'],
                

			]);


			if (!$paymentMethod) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el metodo de pago';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $paymentMethod;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        if(!$paymentMethod)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de pago';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $paymentMethod;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($paymentMethod )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $paymentMethod = PaymentMethod::find($id);

            if (!$paymentMethod) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el metodo de pago';
                return response()->json($this->response, 400);
            }

			$paymentMethod->update([
				'name' => $request['name'],
				'relation' => $request['relation'],
                'type' => $request['type'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $paymentMethod;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if(!$paymentMethod){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el metodo de pago';
            return response()->json($this->response, 400);
        }

        if($paymentMethod->delete()){
            $this->response['data'] = $paymentMethod;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el metodo de pago';
            return response()->json($this->response, 400);
        }
    }
}