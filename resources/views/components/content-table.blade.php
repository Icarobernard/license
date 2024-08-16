<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Rank
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Título do conteúdo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Criado em
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contents as $index => $content)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            @if($content->image)
                                            <div>
                                                <img src="{{ asset('storage/' . $content->image) }}" class="avatar avatar-sm me-3">
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ $index > 0 ? route('content.moveUp', $content->id) : '#' }}"
                                                class="btn btn-link {{ $index === 0 ? 'disabled' : '' }}"
                                                data-bs-toggle="tooltip"
                                                title="Mover para cima"
                                                target="_self">
                                                <svg width="16px" height="16px" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                    <path d="M214.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 109.3 160 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-370.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128z" />
                                                </svg>
                                            </a>

                                            <a href="{{ $index < $contents->count() - 1 ? route('content.moveDown', $content->id) : '#' }}"
                                                class="btn btn-link {{ $index === $contents->count() - 1 ? 'disabled' : '' }}"
                                                data-bs-toggle="tooltip"
                                                title="Mover para baixo"
                                                target="_self">
                                                <svg width="16px" height="16px" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                    <path d="M169.4 502.6c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 402.7 224 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 370.7L86.6 329.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $content->title }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <form action="{{ route('content.updateStatus', $content->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-check form-switch">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="flexSwitchCheck{{ $content->id }}"
                                                        name="status"
                                                        {{ $content->status === 'published' ? 'checked' : '' }}
                                                        onchange="this.form.submit()">
                                                    <label class="form-check-label" for="flexSwitchCheck{{ $content->id }}">
                                                        {{ $content->status === 'published' ? 'Publicado' : 'Rascunho' }}
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $content->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('content.edit', $content->id) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Editar conteúdo">
                                                <svg width="16px" height="16px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                                </svg>
                                            </a>
                                            <!-- Formulário para deletar -->
                                            <form action="{{ route('content.destroy', $content->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button data-bs-toggle="tooltip" data-bs-original-title="Deletar produto" type="submit" class="btn btn-link text-danger m-1" onclick="return confirm('Certeza que quer deletar este produto?')">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>