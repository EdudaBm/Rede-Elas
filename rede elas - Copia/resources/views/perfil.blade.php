@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<div class="container">
    <h1>Meu Perfil</h1>
    <p>Nome: {{ auth()->user()->name ?? 'Visitante' }}</p>
    <p>Email: {{ auth()->user()->email ?? '---' }}</p>
</div>
@endsection