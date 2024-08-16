@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4  mt-2">
  <div class="row">
    <!-- Seção de Ofertas -->

    <!-- <div class="col-lg-12 text-center mt-2 mb-0">
      <h2 class="special-message">
        Aqui está <span>conteúdos</span> deste incrível produto!
      </h2>
    </div> -->
    <!-- Seção de Planos -->
    <div class="col-md-12 mt-4">
      <div class="row">
        <div class="swiper mySwiper">
          <h4 class="text-white mb-0 fadeIn1 fadeInBottom mb-3">Conteúdos</h4>
          <div class="swiper-wrapper">
            @foreach ($contents as $content)
            <div class="swiper-slide">
              <a href="/conteudo/{{$content->id}}">
                <div>
                  <img src="{{ asset('storage/' . $content->image) }}" alt="content Image">
                </div>
              </a>
            </div>

            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
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
    background: rgba(0, 0, 0, 0.3);
    /* Overlay */
  }

  .special-message {
    text-align: center;
  }

  .special-message span {
    color: pink;
  }
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
    overflow: hidden; 
}

.swiper-slide img {
    border-radius: 2%;
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s linear; 
}

.swiper-slide:hover {
    transform: translateY(-10px);
}

.swiper-slide img:hover {
    transform: scale(1.05);
}

</style>