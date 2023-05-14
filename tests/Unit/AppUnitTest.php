<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\SearchController;

class AppUnitTest extends TestCase
{
    protected $searchController;

    /**
     * Setup do teste.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->searchController = new SearchController();
    }

    /**
     * Testa se as variáveis de ambiente estão definidas.
     *
     * @return void
     */
    public function test_env_variables(): void
    {
        $this->assertNotNull(env('GITHUB_CLIENT_ID'));
        $this->assertNotNull(env('GITHUB_CLIENT_SECRET'));
    }

    /**
     * Testa o método index do SearchController.
     *
     * @return void
     */
    public function test_index_method(): void
    {
        $this->assertEquals(
            view('search'),
            $this->searchController->index()
        );
    }

    /**
     * Testa o método search do SearchController.
     *
     * @return void
     */
    public function test_search_method(): void
    {
        $request = SearchRequest::create('/search', 'GET', ['username' => 'laravel']);

        $this->assertThat(
            $this->searchController->search($request),
            $this->isInstanceOf('Illuminate\View\View')
        );
    }

    /**
     * Testa se a mensagem de erro está sendo retornada corretamente.
     *
     * @return void
     */
    public function test_search_request_messages_method(): void
    {
        $request = SearchRequest::create('/search', 'GET', ['username' => '']);

        $this->searchController->search($request);

        $this->assertNotEmpty($request->messages());
    }
}
