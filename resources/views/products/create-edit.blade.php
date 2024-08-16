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
                                                    <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                    <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
                                                    <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">{{ __('Gerenciamento de produto') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @if(session('success'))
            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                <span class="alert-text text-white">
                    {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    X
                </button>
            </div>
            @endif
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1 cursor-pointer" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                            Produto
                        </a>
                        <!-- <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Produto</button> -->
                    </li>
                    @if(isset($product))
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                            Conteúdo
                        </a>
                        <!-- <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Conteúdo</button> -->
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @if(isset($product))
                    <h6 class="mb-0">{{ __('Editar Produto') }}</h6>
                    @else
                    <h6 class="mb-0">{{ __('Novo Produto') }}</h6>
                    @endif
                    <div class="card-body pt-4 p-3">
                        <form action="@if(isset($product)) {{ route('products.update', $product->id) }} @else {{ route('products.store') }} @endif" method="POST" role="form text-left" enctype="multipart/form-data">
                            @csrf
                            @if(isset($product))
                            @method('PUT')
                            @endif
                            @if($errors->any())
                            <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{$errors->first()}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    X
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="form-control-label">Imagem</label>
                                        <div class="@error('image')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                            @error('image')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment-type" class="form-control-label">Tipo de Pagamento</label>
                                        <select class="form-control" id="payment-type" name="payment_type">
                                            <option value="hotmart" {{ old('payment_type', isset($product) && $product->payment_type == 'Hotmart' ? 'selected' : '') }}>Hotmart</option>
                                            <option value="Outro" {{ old('payment_type', isset($product) && $product->payment_type == 'Outro' ? 'selected' : '') }}>Outro</option>
                                        </select>
                                        @error('payment_type')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                @if(isset($product->image))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img height="100px" width="100px" src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" type="checkbox" id="is-free" name="is_free" value="true" {{ isset($product) && $product->is_free ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is-free">Produto gratuito?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="custom_url" class="form-control-label">URL Customizada</label>
                                        <div class="@error('custom_url')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="text" placeholder="Caso um usuário não tenha acesso à esse produto, ele será redirecionado para essa URL." id="custom_url" name="custom_url" value="{{ old('custom_url', isset($product) ? $product->custom_url : '') }}">
                                            @error('custom_url')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="update-id" class="form-control-label">Tem Atualizações?</label>
                                        <select class="form-control" id="update-id" name="update_id" onchange="toggleTextField(this, 'update-ids')">
                                            <option value="nao" {{ old('update_id', isset($product) && !$product->update_id ? 'selected' : '') }}>Não</option>
                                            <option value="sim" {{ old('update_id', isset($product) && $product->update_id ? 'selected' : '') }}>Sim</option>
                                        </select>
                                        <input type="text" id="update-ids" name="update_id" class="form-control mt-2" style="display: {{ old('update_id', isset($product) && $product->update_id ? 'block' : 'none') }};" placeholder="ID de produto Atualização" value="{{ old('update_id', isset($product) ? $product->update_id : '') }}">
                                        @error('update_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unlimited-subdomain-id" class="form-control-label">Tem Subdomínio Ilimitado?</label>
                                        <select class="form-control" id="unlimited-subdomain-id" name="unlimited_subdomain_id" onchange="toggleTextField(this, 'subdomain-ids')">
                                            <option value="nao" {{ old('unlimited_subdomain_id', isset($product) && !$product->unlimited_subdomain_id ? 'selected' : '') }}>Não</option>
                                            <option value="sim" {{ old('unlimited_subdomain_id', isset($product) && $product->unlimited_subdomain_id ? 'selected' : '') }}>Sim</option>
                                        </select>
                                        <input type="text" id="subdomain-ids" name="unlimited_subdomain_id" class="form-control mt-2" style="display: {{ old('unlimited_subdomain_id', isset($product) && $product->unlimited_subdomain_id ? 'block' : 'none') }};" placeholder="ID do produto de Subdomínios ilimitados" value="{{ old('unlimited_subdomain_id', isset($product) ? $product->unlimited_subdomain_id : '') }}">
                                        @error('unlimited_subdomain_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="support-id" class="form-control-label">Tem Suporte Vitalício?</label>
                                        <select class="form-control" id="support-id" name="support_id" onchange="toggleTextField(this, 'support-ids')">
                                            <option value="nao" {{ old('support_id', isset($product) && !$product->support_id ? 'selected' : '') }}>Não</option>
                                            <option value="sim" {{ old('support_id', isset($product) && $product->support_id ? 'selected' : '') }}>Sim</option>
                                        </select>
                                        <input type="text" id="support-ids" name="support_id" class="form-control mt-2" style="display: {{ old('support_id', isset($product) && $product->support_id ? 'block' : 'none') }};" placeholder="ID do produto de Suporte vitalício" value="{{ old('support_id', isset($product) ? $product->support_id : '') }}">
                                        @error('support_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
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
                @if(isset($product))
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h6 class="mb-0">{{ __('Lista de conteúdo') }}</h6>
                    <div class="card-body pt-4 p-3">
                        @include('components.content-table')
                    </div>
                    <h6 class="mb-0">{{ __('Criar Conteúdo') }}</h6>
                    <div class="card-body pt-4 p-3">
                        <form action="@if(isset($product)) {{ route('content.store') }} @endif" method="POST" role="form text-left" enctype="multipart/form-data">
                            @csrf
                            @if(isset($product))
                            @method('POST')
                            @endif
                            @if($errors->any())
                            <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{$errors->first()}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    X
                                </button>
                            </div>
                            @endif
                            <input class="form-control" type="hidden" id="product_id" name="product_id" value="{{ old('product_id', isset($product) ? $product->id : '') }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content-title" class="form-control-label">Título do Conteúdo</label>
                                        <div class="@error('title')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="text" placeholder="Título do Conteúdo" id="title" name="title" value="{{ old('title', isset($content) ? $content->title : '') }}">
                                            @error('title')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Descrição</label>
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                    @error('description')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="custom_content" class="form-control-label">Conteúdo Personalizado</label>
                                        <div class="@error('custom_content')border border-danger rounded-3 @enderror">
                                            <textarea class="form-control" id="custom_content" name="custom_content" rows="4" placeholder="Conteúdo Personalizado"></textarea>
                                            @error('custom_content')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content-video_url" class="form-control-label">URL de vídeo</label>
                                        <div class="@error('video_url')border border-danger rounded-3 @enderror">
                                            <input type="text" class="form-control" placeholder="URL do vídeo a ser exibido pro usuário" id="video_url" name="video_url">{{ old('video_url', isset($content) ? $content->video_url : '') }}</input>
                                            @error('video_url')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content-file" class="form-control-label">Imagem</label>
                                        <div class="@error('content_file')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                            @error('content_file')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-md mt-4 mb-4">{{ __('Salvar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.tiny.cloud/1/cy7w7nytc3xbi9e3qfb5onlv2zlsamekj0nw7h6ttfvgcnub/tinymce/6/tinymce.min.js" referrerpolicy="origin">

</script>
<script>
    tinymce.init({
        selector: '#description',
        plugins: 'lists link image preview',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image',
        height: 300
    });

    function toggleTextField(selectElement, textFieldId) {
        var textField = document.getElementById(textFieldId);
        if (selectElement.value === 'sim') {
            textField.style.display = 'block';
        } else {
            textField.style.display = 'none';
            textField.value = '';
        }
    }
</script>

@endsection