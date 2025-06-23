@extends('layouts.app')

@section('content')

  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Editar Produto') }}</div>

              <div class="card-body">
                  <form action="{{ route('produtos.update', ['produto' => $product->id])}}" method="POST">
                      @csrf
                      @method('PUT')                      
                      <div class="row mb-3">
                          <label for="nome_produto" class="col-md-4 col-form-label text-md-end">{{ __('Nome do  Produto') }}</label>

                          <div class="col-md-6">
                              <input id="nome_produto" type="text" class="form-control @error('nome_produto') is-invalid @enderror" name="nome_produto" value="{{ old('nome_produto', $product->nome_produto ?? '') }}" required autocomplete="nome_produto" autofocus>

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
                              <input id="valor_produto" type="text" class="form-control @error('valor_produto') is-invalid @enderror" name="valor_produto" value="{{ old('valor_produto', $product->valor_produto ?? '') }}" required autocomplete="valor_produto">

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      
                      <div class="row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Atualizar') }}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>        
  </div>

@endsection