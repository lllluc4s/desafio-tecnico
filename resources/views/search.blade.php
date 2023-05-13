<!DOCTYPE html>
<html>

<head>
    <title>Busca Repositórios GitHub</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/results.css') }}">
    <script>
        setTimeout(function(){
            let errorDiv = document.querySelector('.error');
            if(errorDiv){
                errorDiv.style.display = 'none';
            }
        }, 3000);
    </script>
</head>

<body class="content">
    <h1>BuscaRepo</h1>
    <h2>Busque os 5 repositórios mais estrelados de um usuário do GitHub.</h2>
    <form method="GET" action="{{ route('search') }}">
        @csrf
        <label for="username">Nome de usuário GitHub:</label>
        <input type="text" name="username" id="username">
        <br>
        <input type="submit" value="Search">
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </form>
</body>

</html>
