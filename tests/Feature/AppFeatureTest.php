<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppFeatureTest extends TestCase
{
    /**
     * Testa se a página de busca está sendo exibida.
     *
     * @return void
     */
    public function test_search_page(): void
    {
        $this->get('/')
        ->assertStatus(200)
        ->assertViewIs('search');
    }

    /**
     * Testa se a busca está sendo feita corretamente.
     *
     * @return void
     */
    public function test_results_page(): void
    {
        $this->get('/search?username=laravel')
        ->assertStatus(200)
        ->assertViewIs('results');
    }

    /**
     * Testa a rota search sem o parâmetro username.
     *
     * @return void
     */
    public function test_search_without_username(): void
    {
        $this->get('/search')
        ->assertStatus(302)
        ->assertSessionHasErrors(['username']);
    }

    /**
     * Testa a rota search com o parâmetro username vazio.
     *
     * @return void
     */
    public function test_search_with_empty_username(): void
    {
        $this->get('/search?username=')
        ->assertStatus(302)
        ->assertSessionHasErrors(['username']);
    }
}
