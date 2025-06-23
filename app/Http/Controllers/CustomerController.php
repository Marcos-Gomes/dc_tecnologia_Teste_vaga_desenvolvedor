<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customer->all();
        return view('app.customer.customer', ['customers'=>$customers]);
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
            'nome' => 'required|min: 3|max:60',
            'cpf' => 'required|cpf|formato_cpf',
            'email' => 'required|email|unique:users,email'
        ]);

        $customer = $this->customer->create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
        ]);

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, $id)
    {        
        $customer = $this->customer->find($id);
        return view('app.customer.update_customer', ['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('message', 'Cliente não encontrado');
        }

        $request->validate([
            'nome' => 'required|min: 3|max:60',            
            'email' => 'required', 'email', Rule::unique('customers')->ignore($customer->id)
        ]);
        
        $update = $customer->update($request->except(['_token', '_method']));         

        if ($update) {
            return redirect()->route('clientes.index');
        };

        return redirect()->back()->with('message', 'Erro ao atualizar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        $customers = $this->customer->find($id);
        $customers->delete();
        
        $customers = $this->customer->all();
        return view('app.customer.customer', ['customers'=>$customers]);
    }
}
