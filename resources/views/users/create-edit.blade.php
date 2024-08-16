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
                                <span class="ms-1">Configuração</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-8 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Editar Perfil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                        @csrf
                        @if(isset($user))
                        @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
                        </div>

                        <div class="form-group">
                            <label for="is_admin">Administrador</label>
                            <select class="form-control" id="is_admin" name="is_admin" required>
                                <option value="1" {{ (isset($user) && $user->is_admin) ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ (isset($user) && !$user->is_admin) ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">{{ isset($user) ? 'Atualizar' : 'Criar' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
