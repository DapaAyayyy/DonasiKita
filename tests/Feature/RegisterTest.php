<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('donatur');

        Schema::create('donatur', function (Blueprint $table): void {
            $table->increments('id_donatur');
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password_hash');
            $table->string('no_hp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->dateTime('tanggal_daftar')->nullable();
        });
    }

    public function test_register_form_posts_named_fields(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('name="nama"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="no_hp"', false)
            ->assertSee('name="alamat"', false)
            ->assertSee('name="password"', false)
            ->assertSee('name="password_confirmation"', false);
    }

    public function test_register_creates_donatur_and_redirects_to_login(): void
    {
        $this->post('/register', [
            'nama' => 'Donatur Baru',
            'email' => 'donatur-baru@example.test',
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Kebaikan No. 123',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'terms' => '1',
        ])
            ->assertRedirect('/login')
            ->assertSessionHas('success');

        $donatur = Schema::getConnection()
            ->table('donatur')
            ->where('email', 'donatur-baru@example.test')
            ->first();

        $this->assertNotNull($donatur);
        $this->assertSame('Donatur Baru', $donatur->nama);
        $this->assertSame('08123456789', $donatur->no_hp);
        $this->assertTrue(Hash::check('secret123', $donatur->password_hash));
    }
}
