@extends('layouts.app')

@section('content')

  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Editar Cliente') }}</div>

              <div class="card-body">
                  <form action="{{ route('clientes.update', ['cliente' => $customer->id])}}" method="POST">
                      @csrf
                      @method('PUT')                      
                      <div class="row mb-3">
                          <label for="nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                          <div class="col-md-6">
                              <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome', $customer->nome ?? '') }}" required autocomplete="name" autofocus>

                              @error('nome')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-3">
                          <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customer->email ?? '') }}" required autocomplete="email">

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