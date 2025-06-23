@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Cadastro de produtos -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Produto') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nome_produto" class="col-md-4 col-form-label text-md-end">{{ __('Nome do Produto') }}</label>

                            <div class="col-md-6">
                                <input id="nome_produto" type="text" class="form-control @error('nome_produto') is-invalid @enderror" name="nome_produto" value="{{ old('nome_produto') }}" required autocomplete="nome_produto" autofocus>

                                @error('nome_produto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="valor_produto" class="col-md-4 col-form-label text-md-end">{{ __('Valor do Produto') }}</label>

                            <div class="col-md-6">
                                <input id="valor_produto" type="text" class="form-control @error('valor_produto') is-invalid @enderror" name="valor_produto" value="{{ old('valor_produto') }}" required autocomplete="valor_produto" autofocus>

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Produto') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>

    <!-- Lista de clientes -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Produtos Cadastrados') }}</div>

                <div class="card-body">
                    @if ($products->isEmpty())
                        <p>{{ __('Nenhum produto cadastrado.') }}</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Nome Produto') }}</th>
                                    <th>{{ __('Valor Produto') }}</th>                                    
                                    <th>{{ __('Ações') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->nome_produto }}</td>
                                        <td>{{ $product->valor_produto }}</td>

                                        <td>
                                            <a href="{{ route('produtos.edit', $product ) }}" class="btn btn-sm btn-primary">
                                                {{ __('Editar') }}
                                            </a>
                                            <form action="{{ route('produtos.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('Tem certeza que deseja apagar?') }}')">
                                                {{ __('Apagar') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
