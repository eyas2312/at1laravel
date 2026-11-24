<?php
namespace Tests\Unit;
use App\Models\User;
use App\Models\Publication;
use App\Policies\PublicationPolicy;
use Tests\TestCase;

class PublicationPolicyTest extends TestCase
{
    public function test_auteur_peut_modifier_et_supprimer_sa_publication(): void
    {
        $auteur = new User();
        $auteur->id = 1;
        $auteur->role = 'user';

        $publication = new Publication();
        $publication->user_id = 1;

        $policy = new PublicationPolicy();

        $this->assertTrue($policy->update($auteur, $publication));
        $this->assertTrue($policy->delete($auteur, $publication));
    }

    public function test_un_autre_utilisateur_ne_peut_pas_modifier_ou_supprimer(): void
    {
        $utilisateur = new User();
        $utilisateur->id = 2;
        $utilisateur->role = 'user';

        $publication = new Publication();
        $publication->user_id = 1;

        $policy = new PublicationPolicy();

        $this->assertFalse($policy->update($utilisateur, $publication));
        $this->assertFalse($policy->delete($utilisateur, $publication));
    }

    public function test_un_admin_peut_modifier_et_supprimer_toute_publication(): void
    {
        $admin = new User();
        $admin->id = 3;
        $admin->role = 'admin';

        $publication = new Publication();
        $publication->user_id = 1;

        $policy = new PublicationPolicy();

        $this->assertTrue($policy->update($admin, $publication));
        $this->assertTrue($policy->delete($admin, $publication));
    }
}
