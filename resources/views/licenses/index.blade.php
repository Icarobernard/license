@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Todas as Licenças</h5>
                        </div>
                    </div>

                    <!-- Formulário de Pesquisa com POST -->
                    <form method="POST" action="{{ route('licenses.search') }}" class="mt-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Pesquisar por licença" value="{{ old('search', request('search')) }}">
                            <button type="submit" class="btn bg-gradient-primary btn-sm mb-0">Pesquisar</button>
                        </div>
                    </form>
                </div>

                @if (session('success'))
                <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        X
                    </button>
                </div>
                @endif

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @if($licenses->isEmpty())
                        <div class="text-center">
                            <p class="text-xs font-weight-bold mb-0">Não há licenças disponíveis.</p>
                        </div>
                        @else
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome da licença</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chave</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($licenses as $license)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $license->id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $license->license_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $license->license_key }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if($license->status == 'active')
                                        <span class="badge badge-sm bg-gradient-success">ativa</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-secondary">{{ $license->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $license->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $license->client_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $license->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <!-- Link para editar -->
                                            <a href="{{ route('licenses.edit', $license->id) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Editar Licença">
                                                <svg width="16px" height="16px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                                </svg>
                                            </a>

                                            <!-- Formulário para deletar -->
                                            <form action="{{ route('licenses.destroy', $license->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button data-bs-toggle="tooltip" data-bs-original-title="Deletar Licença" type="submit" class="btn btn-link text-danger m-1" onclick="return confirm('Certeza que quer deletar esta licença?')">
                                                    <svg width="16px" height="16px" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection