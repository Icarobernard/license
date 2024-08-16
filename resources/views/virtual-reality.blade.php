@extends('layouts.user_type.auth')

@section('content')

<div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-7">
  <div class="container">
    <div class="row pt-10">
      <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-5 text-center">
        <a href="javascript:;" class="avatar avatar-md border-0" data-bs-toggle="tooltip" data-bs-placement="left" title="My Profile">
          <img class="border-radius-lg" alt="Image placeholder" src="../assets/img/team-1.jpg">
        </a>
        <button class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
          <i class="fas fa-home p-2"></i>
        </button>
        <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Search">
          <i class="fas fa-search p-2"></i>
        </button>
        <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Minimize">
          <i class="fas fa-ellipsis-h p-2"></i>
        </button>
      </div>
      <div class="col-lg-8 col-md-11">
        <div class="d-flex">
          <div class="me-auto">
            <h1 class="display-1 font-weight-bold mt-n4 mb-0">Nodz</h1>
            <h6 class="text-uppercase mb-0 ms-1">Cloudy</h6>
          </div>
          <!-- <div class="ms-auto">
            <img class="w-50 float-end mt-lg-n4" src="../assets/img/small-logos/icon-sun-cloud.png" alt="image sun">
          </div> -->
        </div>
        <div class="row mt-4">
          <!-- Área de Membros Card -->
          <div class="col-lg-6 col-md-6">
            <div class="card move-on-hover overflow-hidden">
              <div class="card-body">
                <h5 class="card-title">Área de Membros</h5>
                <p class="card-text">Acesse conteúdos exclusivos e gerencie seu perfil de membro.</p>
                <a href="#" class="btn btn-primary">Acessar</a>
              </div>
            </div>
          </div>
          <!-- Gerir Licenças Card -->
          <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
            <div class="card move-on-hover overflow-hidden">
              <div class="card-body">
                <h5 class="card-title">Gerir Licenças</h5>
                <p class="card-text">Administre suas licenças e veja detalhes sobre suas subscrições.</p>
                <a href="#" class="btn btn-primary">Gerenciar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
