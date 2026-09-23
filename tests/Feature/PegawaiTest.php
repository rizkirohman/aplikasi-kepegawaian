<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_cannot_access_data_pegawai(): void
    {
        $response = $this->get('/pegawai');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_data_pegawai(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get('/pegawai');

        $response->assertStatus(200);
    }
}
