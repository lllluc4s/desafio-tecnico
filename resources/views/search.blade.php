<!DOCTYPE html>
<html>

<head>
    <title>Busca Repositórios GitHub</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body class="content">
    <h1>BuscaRepo</h1>
    <hr>
    <h2>Busque os 5 repositórios mais estrelados de um usuário do GitHub.</h2>
    <form method="GET" action="{{ route('search') }}">
        @csrf
        <label for="username">Nome de usuário do GitHub:</label>
        <input type="text" name="username" id="username">
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <input class="btn" type="submit" value="Buscar">
    </form>
</body>

</html>
