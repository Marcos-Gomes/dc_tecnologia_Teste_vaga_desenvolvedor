@extends('layouts.app')

@section('content')

<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Selecionar Cliente') }}</div>

                <table class="table table-striped">
                    <thead>
                        <tr>                                                                
                            <th>{{ __('Cliente') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>    
                                <select class="form-select form-select-sm" id="produto">
                                    <option value="">Selecione o Cliente</option>
                                    @foreach ($allCustomers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->id }} | {{ $customer->nome }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>                                
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>

<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Venda') }}</div>

                <table class="table table-striped">
                    <thead>
                        <tr>                                    
                            <th>{{ __('Produto') }}</th>
                            <th>{{ __('Quantidade') }}</th>
                            <th>{{ __('Valor Unitário') }}</th>                                    
                            <th>{{ __('Subtotal') }}</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>    
                                <select class="form-select form-select-sm" id="produto_select" onchange="atualizarValor()">
                                    <option value="">Selecione o Produto</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}" data-valor="{{ $product->valor_produto }}">
                                            {{ $product->nome_produto }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" id="quantidade_produto" oninput="atualizarSubtotal()">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="valor_unitario_produto">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="subtotal" placeholder=" ">
                            </td>
                        </tr>                                
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>

<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Parcelar Compra') }}</div>

                <table class="table table-striped">
                    <thead>
                        <tr>                                    
                            <th>{{ __('Parcelas') }}</th>
                            <th>{{ __('Valor Parcelado') }}</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="number" class="form-control" id="parcelas" oninput="atualizarValorParcela()">
                            </td>
                            <td>
                                 <input type="text" class="form-control" id="valor_parcela" readonly>
                            </td>                            
                        </tr>                                
                    </tbody>
                </table>
                <div id="detalhes_parcelas" class="mt-3"></div>
            </div>
        </div>        
    </div>
</div>



<script>
function atualizarValor() {
    const select = document.getElementById('produto_select');
    const valor = select.options[select.selectedIndex].getAttribute('data-valor');
    document.getElementById('valor_unitario_produto').value = valor || '';
    atualizarSubtotal();
}

function atualizarSubtotal() {
    const quantidade = parseFloat(document.getElementById('quantidade_produto').value);
    const valorUnitario = parseFloat(document.getElementById('valor_unitario_produto').value);

    if (!isNaN(quantidade) && !isNaN(valorUnitario)) {
        const subtotal = (quantidade * valorUnitario).toFixed(2);
        document.getElementById('subtotal').value = subtotal;
        atualizarValorParcela(); 
    } else {
        document.getElementById('subtotal').value = '';
        document.getElementById('valor_parcela').value = '';
    }
}

function atualizarValorParcela() {
    const subtotal = parseFloat(document.getElementById('subtotal').value);
    const numeroParcelas = parseInt(document.getElementById('parcelas').value);
    const detalhesDiv = document.getElementById('detalhes_parcelas');

    detalhesDiv.innerHTML = ''; 

    if (!isNaN(subtotal) && !isNaN(numeroParcelas) && numeroParcelas > 0) {
        
        let valorBase = Math.floor((subtotal / numeroParcelas) * 100) / 100;

        let parcelas = new Array(numeroParcelas).fill(valorBase);
        
        let totalGerado = valorBase * numeroParcelas;
        
        let diferenca = (subtotal - totalGerado).toFixed(2);
        
        parcelas[parcelas.length - 1] += parseFloat(diferenca);
        
        document.getElementById('valor_parcela').value = valorBase.toFixed(2);

        let html = `<strong>Parcelado em ${numeroParcelas}x</strong><br>`;
        parcelas.forEach((valor, index) => {
            html += `Parcela ${index + 1}: R$ ${valor.toFixed(2)}<br>`;
        });

        detalhesDiv.innerHTML = html;
    } else {
        document.getElementById('valor_parcela').value = '';
        detalhesDiv.innerHTML = '';
    }
}
</script>
@endsection