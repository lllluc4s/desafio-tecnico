<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;

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
     * @param SearchRequest $request
     *
     * @return View
     */
    public function search(SearchRequest $request)
    {
        $username = $request->input('username');

        try {
            $response = Http::withHeaders([
                'User-Agent' => 'PHP',
            ])
            ->get("https://api.github.com/users/{$username}/repos", [
                'client_id'     => env('GITHUB_CLIENT_ID'), // Pega o client_id da variável de ambiente
                'client_secret' => env('GITHUB_CLIENT_SECRET'), // Pega o client_secret da variável de ambiente
                'sort'          => 'updated', // Ordena por atualização
                'direction'     => 'desc', // Ordena em ordem decrescente
                'per_page'      => 100, // Faz a paginação por 100 que é o máximo permitido
            ]);

            // Se a requisição retornar um array vazio, retorna para a página inicial com uma mensagem de erro
            if ([] === $response->json()) {
                return redirect()
                ->back()
                ->withErrors([
                    'Erro ao encontrar o usuário. Verifique se o nome de usuário está correto.',
                ]);
            }

            // Se a requisição não retornar 200, retorna para a página inicial com uma mensagem de erro
            if (404 === $response->status()) {
                return redirect()
                ->back()
                ->withErrors([
                    'Erro ao encontrar o usuário. Verifique se o nome de usuário está correto.',
                ]);
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
        } catch (Exception $e) {

            // Trata exceções gerais
            return redirect()
            ->back()
            ->withErrors([
                    'Ocorreu um erro inesperado. Por favor, tente novamente.',
                ]);
        } catch (ValidationException $e) {

            // Trata exceções de validação
            return redirect()
            ->back()
            ->withErrors($e->errors());
        } catch (RequestException $e) {

            // Trata exceções de conexão
            $status_code = $e->getCode();

            if (429 === $status_code) {
                return redirect()
                ->back()
                ->withErrors([
                    'O limite de requisições à API do GitHub foi atingido. Por favor, tente novamente mais tarde.',
                ]);
            }

            return redirect()
            ->back()
            ->withErrors([
                'Não foi possível se conectar à API do GitHub. Por favor, tente novamente.',
            ]);
        }
    }
}
