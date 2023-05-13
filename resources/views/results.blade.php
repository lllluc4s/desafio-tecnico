<!DOCTYPE html>
<html>

<head>
    <title>Lista Repositórios</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/results.css') }}">
</head>

<body class="content">
    <h1>Top 5 repositórios do usuário '{{ $data[0]['owner']['login'] }}'</h1>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Stars</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $repo)
            <tr>
                <td>{{ $repo['name'] }}</td>
                <td>{{ $repo['description'] }}</td>
                <td>{{ number_format($repo['stargazers_count'], 0, ',', '.') }}</td>
                <td><a href="{{ $repo['html_url'] }}" target="_blank">{{ $repo['html_url'] }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button>
        <a href="{{ route('home') }}">Voltar</a>
    </button>
</body>

</html>
