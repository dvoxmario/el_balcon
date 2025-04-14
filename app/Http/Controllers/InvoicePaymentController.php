<?php

namespace App\Http\Controllers;

use App\Models\Invoice_payment;
use App\Models\InvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InvoicePaymentController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];

    public function index()
    {
        $query = InvoicePayment::query();




        $this->response['data'] = $query->get();
        return response()->json($this->response,200);
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
			$invoicePayment = InvoicePayment::create([
				'invoice_id'=> $request['invoice_id'],
				'paymentMethod_id' => $request['paymentMethod_id'],
                'value_id' => $request['value_id'],
                
            ]);


            if (!$invoicePayment) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo el pago de la factura';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoicePayment;

        return response()->json($this->response, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoicePayment = InvoicePayment::find($id);
        if(!$invoicePayment)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $invoicePayment;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoicePayment $invoicePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $invoicePayment = InvoicePayment::find($id);

            if (!$invoicePayment) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de pago de factura';
                return response()->json($this->response, 400);
            }

			$invoicePayment->update([
				'invoice_id' => $request['invoice_id'],
				'paymentMethod_id' => $request['paymentMethod_id'],
                'value_id' => $request['value_id' ],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoicePayment;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //post , recibe solo id en la url
    {
        $invoicePayment = InvoicePayment::find($id);

        if(!$invoicePayment){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el usuario';
            return response()->json($this->response, 400);
        }

        if($invoicePayment->delete()){
            $this->response['data'] = $invoicePayment;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el usuario';
            return response()->json($this->response, 400);
        }
    }
}
