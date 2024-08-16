@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Log de Webhook</h1>
    <form action="{{ route('webhook_logs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="error_description">Descrição do Erro</label>
            <textarea name="error_description" id="error_description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Criar Log</button>
    </form>
</div>
@endsection
