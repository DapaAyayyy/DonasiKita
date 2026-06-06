<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LoginRoleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('donatur');
        Schema::dropIfExists('pengelola');

        Schema::create('donatur', function (Blueprint $table): void {
            $table->increments('id_donatur');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password_hash');
        });

        Schema::create('pengelola', function (Blueprint $table): void {
            $table->increments('id_pengelola');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('role')->nullable();
            $table->string('status')->nullable();
        });
    }

    public function test_login_form_submits_selected_role(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('name="login_as"', false)
            ->assertSee('data-login-role="pengelola"', false);
    }

    public function test_pengelola_selection_logs_into_pengelola_account_even_when_email_matches_donatur(): void
    {
        $email = 'akun@example.test';

        $this->seedDonatur($email, 'password-donatur');
        $this->seedPengelola($email, 'password-pengelola');

        $this->post('/login', [
            'email' => $email,
            'password' => 'password-pengelola',
            'login_as' => 'pengelola',
        ])
            ->assertRedirect('/pengelola/dashboard')
            ->assertSessionHas('auth_type', 'pengelola')
            ->assertSessionHas('auth_name', 'Pengelola Test');
    }

    public function test_donatur_selection_logs_into_donatur_account(): void
    {
        $email = 'akun@example.test';

        $this->seedDonatur($email, 'password-donatur');
        $this->seedPengelola($email, 'password-pengelola');

        $this->post('/login', [
            'email' => $email,
            'password' => 'password-donatur',
            'login_as' => 'donatur',
        ])
            ->assertRedirect('/kampanye')
            ->assertSessionHas('auth_type', 'donatur')
            ->assertSessionHas('auth_name', 'Donatur Test');
    }

    private function seedDonatur(string $email, string $password): void
    {
        Schema::getConnection()->table('donatur')->insert([
            'nama' => 'Donatur Test',
            'email' => $email,
            'password_hash' => Hash::make($password),
        ]);
    }

    private function seedPengelola(string $email, string $password): void
    {
        Schema::getConnection()->table('pengelola')->insert([
            'nama' => 'Pengelola Test',
            'email' => $email,
            'password_hash' => Hash::make($password),
            'role' => 'pengelola',
            'status' => 'aktif',
        ]);
    }
}
