<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    /**
     * Mostra a página de busca.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Busca os repositórios do usuário.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
            ],
        ], $this->messages());

        $client_id     = env('GITHUB_CLIENT_ID');
        $client_secret = env('GITHUB_CLIENT_SECRET');
        $username      = $request->input('username');

        $response = Http::withHeaders([
            'User-Agent' => 'PHP',
        ])->get("https://api.github.com/users/{$username}/repos", [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'sort'          => 'updated', // Ordena por atualização
            'direction'     => 'desc',
            'per_page'      => 100, // Faz a paginação por 100 que é o máximo permitido
        ]);

        if (200 !== $response->status()) {
            return redirect()->back()->withErrors(['Erro ao buscar os repositórios do usuário. Tente novamente mais tarde.']);
        }

        $data = $response->json();

        // Ordena por estrelas em ordem decrescente
        usort($data, function ($a, $b) {
            return $b['stargazers_count'] - $a['stargazers_count'];
        });

        // Pega apenas os 5 primeiros
        $data = array_slice($data, 0, 5);

        return view('results', compact('data'));
    }

    /**
     * Retorna as mensagens de validação.
     *
     * @return array
     */
    private function messages()
    {
        return [
            'required' => 'Por favor, informe um nome de usuário.',
        ];
    }
}
