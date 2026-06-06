<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

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

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
