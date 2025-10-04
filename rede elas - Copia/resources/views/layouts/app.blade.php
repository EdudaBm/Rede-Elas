<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Rede Elas')</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    @stack('styles')
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('inicio') }}">Início</a>
            <a href="{{ route('relatos.index') }}">Relatos</a>
            <a href="{{ route('contatos.index') }}">Contatos</a>
            <a href="{{ route('perfil.index') }}">Perfil</a>
            <a href="{{ route('emergencia.index') }}">Emergência</a>
            <a href="{{ route('config.index') }}">Configurações</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Rede Elas © {{ date('Y') }}</p>
    </footer>

    @stack('scripts')
</body>
</html>