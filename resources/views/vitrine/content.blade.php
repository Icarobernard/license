@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4 mt-2">
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="content-wrapper mb-5">
                @if(auth()->user()->is_admin)
                <div class="mb-3">
                <a href="{{ route('content.edit', $content->id) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Editar conteúdo">
                    <svg width="25px" height="25px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                    </svg>
                </a>
                </div>
                @endif
                @if ($content->content_type == 'video' || $content->content_type == 'video/image' || $content->video_url)
                <div class="video-container mb-4">
                    @if (strpos($content->video_url, 'youtube.com') !== false || strpos($content->video_url, 'youtu.be') !== false)
                    <iframe src="{{ str_replace('watch?v=', 'embed/', $content->video_url) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @elseif (strpos($content->video_url, 'vimeo.com') !== false)
                    <iframe src="{{ str_replace('vimeo.com/', 'player.vimeo.com/video/', $content->video_url) }}" title="Vimeo video player" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                    @elseif (strpos($content->video_url, 'pandavideo.com') !== false)
                    <iframe src="{{ $content->video_url }}" title="Panda Video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                    <p class="text-danger">URL de vídeo não suportada.</p>
                    @endif
                </div>
                @endif
                <h2 class="text-white mb-4 ">{{$content->title}}</h2>
                <div class="text-white mb-4 text-start">
                    {!! $content->description !!}
                </div>
                @if ($content->custom_content)
                <div class="text-white mt-4">
                    {!! $content->custom_content !!}
                </div>
                @endif
            </div>
            <div class="d-flex justify-content-between mt-4">
                @if ($prevContent)
                    <a href="{{ route('content.find', $prevContent->id) }}" class="btn btn-outline-success">Voltar</a>
                @else
                    <span class="btn btn-outline-secondary disabled">Voltar</span>
                @endif

                @if ($nextContent)
                    <a href="{{ route('content.find', $nextContent->id) }}" class="btn btn-outline-success">Próximo</a>
                @else
                    <span class="btn btn-outline-secondary disabled">Próximo</span>
                @endif
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection

<style>
    .video-container {
        position: relative;
        padding-top: 56.25%;
        /* 16:9 Aspect Ratio */
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }

    .content-wrapper {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-content {
        background-color: #e9ecef;
        padding: 20px;
        border-radius: 5px;
    }

    h2.text-start,
    .text-start p {
        margin-left: 20px;
        margin-right: 20px;
    }
</style>