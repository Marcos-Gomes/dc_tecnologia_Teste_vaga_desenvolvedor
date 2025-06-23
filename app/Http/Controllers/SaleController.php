<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;


class SaleController extends Controller
{
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->sale->all();
        $allProducts = Product::all();
        
        $customer = $this->sale->all();
        $allCustomers = Customer::all();        

        return view('app.sale.sale', ['allProducts' => $allProducts, 'allCustomers' => $allCustomers]);
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
        $request->validate([
            'cliente_id' => 'required',
            'produto_id' => 'required',
            'valor_venda' => 'required',
            'quantidade' =>'required|integer',
            'numero_parcelas' => 'required|integer',                 
        ]);

        dd($request);

        $product = $this->product->create([
            'nome_produto' => $request->nome_produto,
            'valor_produto' => $request->valor_produto,
        ]);

        return redirect()->route('produtos.index');    
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
