@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/user.png" alt="..." class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ auth()->user()->name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            @if(isset($product))
                <h6 class="mb-0">{{ __('Editar Produto') }}</h6>
            @else
                <h6 class="mb-0">{{ __('Novo Produto') }}</h6>
            @endif
        </div>
        <div class="card-body pt-4 p-3">
            <form action="@if(isset($product)) {{ route('products.update', $product->id) }} @else {{ route('products.store') }} @endif" method="POST" role="form text-left">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif
                @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">
                        {{$errors->first()}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product-name" class="form-control-label">Nome do Produto</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Nome do Produto" id="name" name="name" value="{{ old('name', isset($product) ? $product->name : '') }}">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product-id" class="form-control-label">ID do Produto</label>
                            <div class="@error('product_id')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="ID do Produto" id="product-id" name="product_id" value="{{ old('product_id', isset($product) ? $product->product_id : '') }}">
                                @error('product_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                        @if(isset($product))
                            {{ __('Salvar Alterações') }}
                        @else
                            {{ __('Salvar Produto') }}
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
