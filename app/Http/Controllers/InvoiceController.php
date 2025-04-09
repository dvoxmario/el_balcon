<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InvoiceController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];    
    

    public function index()
    {
        $query = Invoice::query();


        // Busqueda basica por nombre o identificador
        // if ($request->has('search') && $request->search !='') {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orwhere('identifiers','like', '%' . $request->search . '%');

        // }
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
			$invoice= Invoice::create([
				'value' => $request['value'],
				'reservation_id' => $request['reservation_id'],
                'invoice_state_id' => $request['invoice_state_id'],
                

			]);


			if (!$invoice) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se Creo la factura';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoice;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $invoice = Invoice::find($id);
     if(!$invoice)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de factura';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $invoice;
        return response()->json($this->response, 200);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice,$id)
    {
        try {

            $invoice = Invoice::find($id);

            if (!$invoice) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro factura';
                return response()->json($this->response, 400);
            }

			$invoice->update([
				'value' => $request['value'],
                'reservation_id' => $request['reservation_id'],
                'invoice_state' => $request['invoice_state']
				
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoice;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice, $id)
    {
        $invoice = Invoice::find($id);

        if(!$invoice){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado la factura';
            return response()->json($this->response, 400);
        }

        if($invoice->delete()){
            $this->response['data'] = $invoice;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado la factura';
            return response()->json($this->response, 400);
        }
    }
}
