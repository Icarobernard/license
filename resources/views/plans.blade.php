@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <!-- Seção de Ofertas -->

    <div class="col-lg-12 text-center mt-2 mb-0">
      <h2 class="special-message">
        Preparamos <span>condições especiais</span> para você!
      </h2>
    </div>
    <!-- Seção de Planos -->
    <div class="col-md-12 mt-4">
      <div class="row">
        @foreach($offersVisible as $index => $offer)
        <div class="col-md-4 mb-4">
          <div class="cardzin card-pricing">
            <div class="img-container">
              <img src="{{ asset('storage/' . $offer->image) }}" alt="Imagem da Oferta" class="img-fluid">
              <div class="card-content">
                <h5 class="text-white">{{ $offer->name }}</h5>
                <h2 class="text-white mt-2 mb-0">
                  <small>R$</small>{{ number_format($offer->price, 2, ',', '.') }}
                </h2>
                @if($offer->type == 'subscription')
                @if($offer->subscription_type == 'annual')
                @if($offer->subscription_quantity > 1)
                <h6 class="text-white">De {{ $offer->subscription_quantity }} em {{ $offer->subscription_quantity }} anos</h6>
                @elseif($offer->subscription_quantity == 1)
                <h6 class="text-white">Por ano</h6>
                @endif
                @elseif($offer->subscription_type == 'monthly')
                @if($offer->subscription_quantity > 1)
                <h6 class="text-white">De {{ $offer->subscription_quantity }} em {{ $offer->subscription_quantity }} meses</h6>
                @elseif($offer->subscription_quantity == 1)
                <h6 class="text-white">Por mês</h6>
                @endif
                @elseif($offer->subscription_type == 'weekly')
                @if($offer->subscription_quantity > 1)
                <h6 class="text-white">De {{ $offer->subscription_quantity }} em {{ $offer->subscription_quantity }} semanas</h6>
                @elseif($offer->subscription_quantity == 1)
                <h6 class="text-white">Por semana</h6>
                @endif
                @else
                <h6 class="text-white">Tipo de assinatura desconhecido</h6>
                @endif
                @else
                <h6 class="text-white">Vitalício</h6>
                @endif
                <ul class="list-unstyled max-width-200 mx-auto text-success">
                  <li>
                    @if($offer->licenses == 1)
                    <b>0{{ $offer->licenses }}</b> domínio!
                    @elseif($offer->licenses <= 9)
                    <b>0{{ $offer->licenses }}</b> domínios!
                    @else
                    <b>{{ $offer->licenses }}</b> domínios!
                    @endif
                    <hr class="horizontal dark">
                  </li>
                </ul>
                <a href="{{$offer->url}}&email={{auth()->user()->email}}&name={{auth()->user()->name}}&sck={{$offer->utm_source}}&utm_campaign={{$offer->utm_campaign}}&utm_medium={{$offer->utm_medium}}&utm_term={{$offer->utm_term}}&utm_content={{$offer->utm_content}}" class="btn bg-gradient-success w-50 mt-4 mb-0" target="_blank">
                  Comprar
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

<style>
  .cardzin {
    position: relative;
    overflow: hidden;
   border-radius: 30px;
  }

  .img-container {
    width: 100%;
    height: 70vh; 
    overflow: hidden;
    position: relative;
 
  }

  .img-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    
  }

  .card-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.3); /* Overlay */
  }

  .special-message {
    text-align: center;
  }

  .special-message span {
    color: pink;
  }
</style>
