@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <div class="col-md-12 mb-lg-0 mb-4">
          <div class="card mt-4">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Adicionar Domínio</h6>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <form action="{{ route('domains.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-md-0 mb-4">
                    <div class="form-group">
                      <label for="url">URL</label>
                      <input type="text" name="name" class="form-control" placeholder="Digite a URL" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="license_id">Licença</label>
                      <select name="license_id" class="form-control" required>
                        @foreach($licenses as $license)
                        <option value="{{ $license['id'] }}">{{ $license['license_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark mt-3">Adicionar Domínio</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
  <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
    <span class="alert-text text-white">{{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
      X
    </button>
  </div>
  @endif

  @if(session('error'))
  <div class="m-3 alert alert-warning alert-dismissible fade show" id="alert-success" role="alert">
  
  <span class="alert-text text-white">{{ session('error') }}</span>
   <a href="{{ route('planos') }}">clicando aqui!</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
  </div>
  @endif

  <div class="row">
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">Domínios</h6>
        </div>
        <div class="card-body pt-4 p-3">
          <ul class="list-group">
            @forelse($domains as $domain)
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <a href="https://{{ $domain->name }}" target="_blank" class="domain-link">
                  <div class="d-flex align-items-center">
                    <svg width="16px" height="16px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="me-2 text-dark">
                      <path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z" />
                    </svg>
                    <h6 class="mt-2 text-sm">{{ $domain->name }}</h6>
                  </div>
                </a>
                <span class="mb-2 text-xs">Status:
                  @if($domain->license)
                  <span class="badge badge-sm bg-gradient-{{ $domain->license->status == 'active' ? 'success' : 'danger' }}">
                    {{ $domain->license->status }}
                  </span>
                  @else
                  <span class="badge badge-sm bg-gradient-secondary">Sem licença</span>
                  @endif
                </span>
                <span class="mb-2 text-xs">Licença:
                  <span class="text-dark ms-sm-2 font-weight-bold">{{ $domain->license ? $domain->license->license_key : 'N/A' }}</span>
                </span>
              </div>
              <div class="ms-auto text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $domain->id }}">
                  Deletar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal-{{ $domain->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $domain->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="deleteModalLabel-{{ $domain->id }}">Confirmação de Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @if($domain->is_subdomain)
                        Tem certeza de que deseja excluir o subdomínio "{{ $domain->name }}"?
                        @else
                        Tem certeza de que deseja excluir o domínio principal "{{ $domain->name }}" e todos os subdomínios associados?
                        <hr>
                        <h6 class="mb-2 ">Subdomínios associados:</h6>
                        <ul>
                          @forelse($domain->subdomains as $subdomain)
                          <li class="text-danger">{{ $subdomain->name }}</li>
                          @empty
                          <li>Sem subdomínios associados</li>
                          @endforelse
                        </ul>
                        @endif
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('domains.destroy', $domain->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn bg-gradient-primary">Confirmar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            @empty
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm">Sem domínios cadastrados</h6>
              </div>
            </li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
