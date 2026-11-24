<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiPublicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_consultation_publique_des_publications(): void
    {
        $response = $this->getJson('/api/publications');

        $response->assertStatus(200);
    }

    public function test_creation_refusee_sans_authentification(): void
    {
        $response = $this->postJson('/api/publications', [
            'titre' => 'Publication de test',
            'contenu' => 'Contenu de test',
        ]);

        $response->assertUnauthorized();
    }
}
