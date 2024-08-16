@extends('layouts.user_type.auth')

@section('content')
<div style="background-color: black;" id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item">
            <div class="page-header min-vh-75 border-radius-xl" style="background-image: url('../assets/img/banner_supercombo.jpg');">
                <span class="mask bg-gradient-white"></span>
                <div class="overlay"></div>
                <div class="container m-5">
                    <div class="row">
                        <div class="col-lg-8 my-auto">
                            <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Imperdível!</h4>
                            <h3 class="text-white fadeIn2 fadeInBottom">Super Combo com 65% de Desconto! Acesso Vitalício!</h3>
                            <p class="lead text-white fadeIn3 fadeInBottom">Aproveite esta oferta imperdível e garanta acesso vitalício aos nossos melhores softwares de marketing digital com um desconto incrível de 65%! Este combo exclusivo inclui ferramentas poderosas para impulsionar suas campanhas, aumentar suas vendas e otimizar suas estratégias digitais.</p>
                            <a href="https://nodz.top/anuncios-automaticos/?utm_source=cademi&utm_medium=vitrine&utm_campaign=anuncios+automaticos&utm_content=banner&utm_term=promo+destaque" class="text-dark icon-move-right" target="_blank">
                                <button type="button" class="btn btn-white btn-lg w-70">Quero saber mais sobre o Super Combo</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="page-header min-vh-75 border-radius-xl" style="background-image: url('../assets/img/banner_anuncioautomatico.png');">
                <span class="mask bg-gradient-white"></span>
                <div class="overlay"></div>
                <div class="container m-5">
                    <div class="row">
                        <div class="col-lg-8 my-auto">
                            <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Anúncios Automáticos:</h4>
                            <h3 class="text-white fadeIn2 fadeInBottom">Seu Atalho para Anúncios de Alto Desempenho</h3>
                            <p class="lead text-white fadeIn3 fadeInBottom">Transforme sua estratégia de marketing com Anúncios Automáticos! Economize Tempo e Esforço com IA para Campanhas Lucrativas.</p>
                            <a href="https://nodz.top/anuncios-automaticos/?utm_source=cademi&utm_medium=vitrine&utm_campaign=anuncios+automaticos&utm_content=banner&utm_term=promo+destaque" class="text-dark icon-move-right" target="_blank">
                                <button type="button" class="btn btn-white btn-lg w-90">Simplifique seus anúncios e aumente seus lucros como afiliado!</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item active">
            <div class="page-header min-vh-75 border-radius-xl" style="background-image: url('../assets/img/banner_superpresell.png');">
                <span class="mask bg-gradient-white"></span>
                <div class="overlay"></div>
                <div class="container m-5">
                    <div class="row">
                        <div class="col-lg-6 my-auto">
                            <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Crie Presells Deslumbrantes Sem Nenhuma Habilidade de Programação!</h4>
                            <h3 class="text-white fadeIn2 fadeInBottom">Super Presell</h3>
                            <p class="lead text-white fadeIn3 fadeInBottom">Descubra o Super Presell: seu aliado na criação de páginas presell incríveis! Arraste e solte elementos com nosso editor visual, escolha modelos ou comece do zero. Velocidade ultra-rápida, personalização total e sem limites de nicho. Transforme suas ideias em vendas hoje!</p>
                            <a href="https://superpresell.top/?utm_source=cademi&utm_medium=vitrine&utm_campaign=superpresell&utm_content=banner&utm_term=promo+destaque" class="text-dark icon-move-right" target="_blank">
                                <button type="button" class="btn btn-white btn-lg w-70">Quero conhecer o Super Presell!</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon position-absolute bottom-40" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <div class="swiper mySwiper">
        <h4 class="text-white mb-0 fadeIn1 fadeInBottom mb-3">Ferramentas</h4>
        <div class="swiper-wrapper">
            @foreach ($products as $product)
            <div class="swiper-slide">
                @if (isset($product->is_free) == false && isset($product->custom_url) == false || !app('App\Http\Controllers\MemberAreaController')->hasActiveLicense($product->product_id) && isset($product->custom_url) == false && !$product->is_free)
                <a href="/planos/{{$product->name}}" title="Comprar {{$product->name}}" target="_self">
                    @elseif (isset($product->is_free) == false && isset($product->custom_url) == true || !app('App\Http\Controllers\MemberAreaController')->hasActiveLicense($product->product_id) && isset($product->custom_url) == true && !$product->is_free)
                    <a href="https://{{$product->custom_url}}" title="Comprar {{$product->name}}" target="_blank">
                        @elseif($product->is_free || app('App\Http\Controllers\MemberAreaController')->hasActiveLicense($product->product_id))
                        <a href="/vitrine/{{$product->id}}">
                            @endif
                            <div>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                                @if (!$product->is_free && !app('App\Http\Controllers\MemberAreaController')->hasActiveLicense($product->product_id) != false)
                                <svg class="icon-locked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z" />
                                </svg>
                                @endif
                            </div>
                        </a>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

</div>

<style>
    .swiper {
        width: 95%;
        height: 60%;
        background-color: black;
        cursor: grab;
        position: relative;
    }

    .swiper-slide {
        cursor: pointer;
        text-align: center;
        font-size: 18px;
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        transition: transform 0.3s linear;
    }

    .swiper-slide img {
        border-radius: 2%;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-slide img:hover {
        border-radius: 2%;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .icon-locked {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        fill: white;

        display: flex;
        justify-content: center;
        align-items: center;
        background-size: 100px;
    }

    .swiper-slide:hover {
        transform: translateY(-10px);
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 100%);
        pointer-events: none;
    }
</style>
@endsection