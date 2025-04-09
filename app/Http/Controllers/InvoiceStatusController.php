<?php

namespace App\Http\Controllers;

use App\Models\Invoice_status;
use App\Models\InvoiceStatus;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InvoiceStatusController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];    

    public function index()
    {
        $query = InvoiceStatus::query();


        $this->response['data'] = $query->get();
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
			$invoiceStatus = InvoiceStatus::create([
				'name' => $request['name']
				

			]);


			if (!$invoiceStatus) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo la factura';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoiceStatus;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoiceStatus = InvoiceStatus::find($id);
        if(!$invoiceStatus)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $invoiceStatus;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceStatus $invoiceStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $invoiceStatus = InvoiceStatus::find($id);

            if (!$invoiceStatus) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el tipo de factura';
                return response()->json($this->response, 400);
            }

			$invoiceStatus->update([
				'name' => $request['name'],
				
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoiceStatus;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoiceStatus = InvoiceStatus::find($id);

        if(!$invoiceStatus){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la factura';
            return response()->json($this->response, 400);
        }

        if($invoiceStatus->delete()){
            $this->response['data'] = $invoiceStatus;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado la factura';
            return response()->json($this->response, 400);
        }
    }
}
