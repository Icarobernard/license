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
            @if(isset($offer))
                <h6 class="mb-0">{{ __('Editar Oferta') }}</h6>
            @else
                <h6 class="mb-0">{{ __('Nova Oferta') }}</h6>
            @endif
        </div>
        <div class="card-body pt-4 p-3">
            <form action="@if(isset($offer)) {{ route('offers.update', $offer->id) }} @else {{ route('offers.store') }} @endif" method="POST" role="form text-left">
                @csrf
                @if(isset($offer))
                    @method('PUT')
                @endif
                @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">{{$errors->first()}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product-id" class="form-control-label">Produto</label>
                            <div class="@error('product_id')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="product-id" name="product_id">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ isset($offer) && $offer->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nome da Oferta</label>
                            <div class="@error('name')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Nome da Oferta" id="name" name="name" value="{{ isset($offer) ? $offer->name : '' }}">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="form-control-label">Tipo de Oferta</label>
                            <div class="@error('type')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="type" name="type">
                                    <option value="subscription" {{ isset($offer) && $offer->type == 'subscription' ? 'selected' : '' }}>Assinatura</option>
                                    <option value="lifetime" {{ isset($offer) && $offer->type == 'lifetime' ? 'selected' : '' }}>Vitalício</option>
                                </select>
                                @error('type')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="licenses" class="form-control-label">Número de Licenças</label>
                            <div class="@error('licenses')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="number" placeholder="Número de Licenças" id="licenses" name="licenses" value="{{ isset($offer) ? $offer->licenses : '' }}">
                                @error('licenses')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                        @if(isset($offer))
                            {{ __('Salvar Alterações') }}
                        @else
                            {{ __('Salvar Oferta') }}
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
