@extends('layouts.app')

@section('title', 'Relatos')

@section('content')
<div class="container">
    <h1>Relatos</h1>

    <form action="{{ route('relatos.store') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="descricao" placeholder="Escreva seu relato" required></textarea>
        <button type="submit">Enviar</button>
    </form>

    <h2>Últimos relatos</h2>
    <ul>
        @foreach($relatos as $relato)
            <li>
                <strong>{{ $relato->titulo }}</strong> <br>
                {{ $relato->descricao }}
            </li>
        @endforeach
    </ul>
</div>
@endsection