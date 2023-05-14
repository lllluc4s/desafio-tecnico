<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    /**
     * Mostra a página de busca.
     *
     * @return View
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Busca os repositórios do usuário.
     *
     * @param Request $request
     *
     * @return View
     */
    public function search(Request $request)
    {
        // Valida o campo username como obrigatório e string
        $request->validate([
            'username' => [
                'required',
                'string',
            ],
        ], $this->messages());

        $username = $request->input('username');
        $response = Http::withHeaders([
            'User-Agent' => 'PHP',
        ])->get("https://api.github.com/users/{$username}/repos", [
            'client_id'     => env('GITHUB_CLIENT_ID'), // Pega o client_id da variável de ambiente
            'client_secret' => env('GITHUB_CLIENT_SECRET'), // Pega o client_secret da variável de ambiente
            'sort'          => 'updated', // Ordena por atualização
            'direction'     => 'desc', // Ordena em ordem decrescente
            'per_page'      => 100, // Faz a paginação por 100 que é o máximo permitido
        ]);

        // Se a requisição não retornar 200, retorna para a página inicial com uma mensagem de erro
        if (200 !== $response->status()) {
            return redirect()->back()->withErrors(['Erro ao buscar os repositórios do usuário. Tente novamente mais tarde.']);
        }

        // Pega os dados da resposta
        $data = $response->json();

        // Ordena por estrelas em ordem decrescente
        usort($data, function ($a, $b) {
            return $b['stargazers_count'] - $a['stargazers_count'];
        });

        // Pega apenas os 5 primeiros
        $data = array_slice($data, 0, 5);

        // Retorna a view com os dados
        return view('results', compact('data'));
    }

    /**
     * Retorna as mensagens de validação.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Por favor, informe um nome de usuário.',
        ];
    }
}
