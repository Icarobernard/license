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
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-controls="dashboard" aria-selected="false">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>Configuração</title>
                                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                <g id="settings" transform="translate(304.000000, 151.000000)">
                                                    <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                    </polygon>
                                                    <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
                                                    <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">{{ __('Configuração de ofertas') }}</span>
                            </a>
                        </li>
                    </ul>
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
            <form action="@if(isset($offer)) {{ route('offers.update', $offer->id) }} @else {{ route('offers.store') }} @endif" method="POST" role="form text-left" enctype="multipart/form-data">
                @csrf
                @if(isset($offer))
                @method('PUT')
                @endif
                @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">{{$errors->first()}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        X
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
                                <select class="form-control" id="type" name="type" onchange="toggleSubscriptionFields()">
                                    <option value="subscription" {{ isset($offer) && $offer->type == 'subscription' ? 'selected' : '' }}>Assinatura</option>
                                    <option value="lifetime" {{ isset($offer) && $offer->type == 'lifetime' ? 'selected' : '' }}>Vitalícia</option>
                                </select>
                                @error('type')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="licenses" class="form-control-label">Quantidade de Licenças</label>
                            <div class="@error('licenses')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="number" placeholder="Quantidade de Licenças" id="licenses" name="licenses" value="{{ isset($offer) ? $offer->licenses : '' }}">
                                @error('licenses')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 subscription-field" style="display: none;">
                        <div class="form-group">
                            <label for="subscription_type" class="form-control-label">Tipo de assinatura</label>
                            <div class="@error('subscription_type')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="subscription_type" name="subscription_type">
                                    <option value="annual" {{ isset($offer) && $offer->subscription_type == 'annual' ? 'selected' : '' }}>Anualmente</option>
                                    <option value="monthly" {{ isset($offer) && $offer->subscription_type == 'monthly' ? 'selected' : '' }}>Mensalmente</option>
                                    <option value="weekly" {{ isset($offer) && $offer->subscription_type == 'weekly' ? 'selected' : '' }}>Semanalmente</option>
                                </select>
                                @error('subscription_type')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 subscription-field" style="display: none;">
                        <div class="form-group">
                            <label for="subscription_quantity" class="form-control-label">Tempo de cobrança</label>
                            <div class="@error('subscription_quantity')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="number" placeholder="Ex: 1 + anualmente (de 1 e 1 ano) 2 + mensalmente (cobrança bimestral) " id="subscription_quantity" name="subscription_quantity" value="{{ isset($offer) ? $offer->subscription_quantity : '' }}">
                                @error('subscription_quantity')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @if(isset($offer->image))
                                <img height="100px" width="100px" src="{{ asset('storage/' . $offer->image) }}" alt="Imagem da Oferta" class="img-fluid">
                                @endif
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="is-visible" name="is_visible" value="true" onchange="toggleVisibilityFields()" {{ isset($offer) && $offer->is_visible ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is-visible">Visível nos planos?</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Imagem</label>
                                <div class="@error('image')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                    @error('image')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="form-control-label">Imagem</label>
                                <div class="@error('image')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="file" id="image" name="image"  accept="image/*">
                                    @error('image')
                                    <p class="text-danger text-xs mt-">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">URL</label>
                                <div class="@error('checkout_url')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="URL do Checkout" id="url" name="url" value="{{ isset($offer) ? $offer->url : '' }}">
                                    @error('checkout_url')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">Preço</label>
                                <div class="@error('price')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="price" name="price" value="{{ isset($offer) ? $offer->price : '' }}">
                                    @error('price')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">UTM Source</label>
                                <div class="@error('utm_source')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="UTM Source" id="offer_id" name="utm_source" value="{{ isset($offer) ? $offer->utm_source : '' }}">
                                    @error('utm_source')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">UTM Campaign</label>
                                <div class="@error('checkout_url')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="utm_campaign" name="utm_campaign" value="{{ isset($offer) ? $offer->utm_campaign : '' }}">
                                    @error('utm_campaign')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">UTM Medium</label>
                                <div class="@error('utm_medium')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="utm_medium" name="utm_medium" value="{{ isset($offer) ? $offer->utm_source : '' }}">
                                    @error('utm_source')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">UTM Term</label>
                                <div class="@error('checkout_url')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="utm_term" name="utm_term" value="{{ isset($offer) ? $offer->utm_term : '' }}">
                                    @error('utm_term')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group checkout-field" style="display: none;">
                                <label for="checkout_url" class="form-control-label">UTM Content</label>
                                <div class="@error('utm_medium')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="utm_content" name="utm_content" value="{{ isset($offer) ? $offer->utm_content : '' }}">
                                    @error('utm_content')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark">{{ isset($offer) ? 'Atualizar' : 'Salvar' }}</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleSubscriptionFields();
        toggleVisibilityFields();
    });

    function toggleSubscriptionFields() {
        var typeSelect = document.getElementById('type');
        var subscriptionFields = document.querySelectorAll('.subscription-field');

        if (typeSelect.value === 'subscription') {
            subscriptionFields.forEach(function(field) {
                field.style.display = 'block';
            });
        } else {
            subscriptionFields.forEach(function(field) {
                field.style.display = 'none';
            });
        }
    }

    function toggleVisibilityFields() {
        var isVisible = document.getElementById('is-visible').checked;
        var checkoutFieldContainer = document.querySelectorAll('.checkout-field');
        if (isVisible) {
            checkoutFieldContainer.forEach(function(field) {
                field.style.display = 'block';
            });
            // checkoutFieldContainer.style.display = 'block';
        } else {
            // checkoutFieldContainer.style.display = 'none';
            checkoutFieldContainer.forEach(function(field) {
                field.style.display = 'none';
            });
        }
    }
</script>

@endsection