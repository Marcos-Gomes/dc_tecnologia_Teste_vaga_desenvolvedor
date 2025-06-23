<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product->all();
        return view('app.product.product', ['products'=>$products]);
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
            'nome_produto' => 'required|min: 3|max:60',
            'valor_produto' => 'required|numeric|decimal:2',            
        ]);

        $product = $this->product->create([
            'nome_produto' => $request->nome_produto,
            'valor_produto' => $request->valor_produto,
        ]);

        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $product = $this->product->find($id);
        return view('app.product.update_product', ['product'=>$product]);
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('message', 'Produto não encontrado');
        }

        $request->validate([
            'nome_produto' => 'required|min: 3|max:60',
            'valor_produto' => 'required|numeric|decimal:2',            
        ]);
        
        $update = $product->update($request->except(['_token', '_method']));         

        if ($update) {
            return redirect()->route('produtos.index');
        };

        return redirect()->back()->with('message', 'Erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $products = $this->product->find($id);
        $products->delete();
        
        $products = $this->product->all();
        return view('app.product.product', ['products'=>$products]);
    }
}
