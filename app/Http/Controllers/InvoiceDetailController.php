<?php

namespace App\Http\Controllers;

use App\Models\Invoice_detail;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InvoiceDetailController extends Controller
{
    private $response = [
        'status' => 'ok',
        'message' => 'null',
        'data' => []

    ];
    public function index()
    {
        $query = InvoiceDetail::query();


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
			$invoiceDetail = InvoiceDetail::create([
				'name' => $request['name'],
				'value' => $request['value'],
                'invoice_id' => $request['invoice_id'],
                'product_id' => $request['product_id'],

			]);


			if (!$invoiceDetail) {
				$this->response['status'] = 'error';
                $this->response['message'] = 'no se creo el detalle de la factura';
                return response()->json($this->response, 500);
			}

		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoiceDetail;

        return response()->json($this->response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoiceDetail = InvoiceDetail::find($id);
        if(!$invoiceDetail)
        {
            $this->response['status'] = 'error';
            $this->response['message'] = 'no se encontro el tipo de identificación';
            return response()->json($this->response, 400);
        }

        $this->response['data'] = $invoiceDetail;
        return response()->json($this->response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $invoiceDetail = InvoiceDetail::find($id);

            if (!$invoiceDetail) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'no se encontro el detalle de la factura';
                return response()->json($this->response, 400);
            }

			$invoiceDetail->update([
				'name' => $request['name'],
				'value_id' => $request['value_id'],
                'invoice_id' => $request['invoice_id'],
                'product_id' => $request['product_id'],
			]);


		} catch (QueryException $e) {
			return $this->response['message'] = $e->getMessage();
		}

        $this->response['data'] = $invoiceDetail;

        return response()->json($this->response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoiceDetail = InvoiceDetail::find($id);

        if(!$invoiceDetail){
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha encontrado el detalle de la factura';
            return response()->json($this->response, 400);
        }

        if($invoiceDetail->delete()){
            $this->response['data'] = $invoiceDetail;
            return response()->json($this->response, 200);
        }
        else{
            $this->response['status'] = 'error';
            $this->response['message'] = 'No se ha eliminado el detalle de la factura';
            return response()->json($this->response, 400);
        }
    }
}
