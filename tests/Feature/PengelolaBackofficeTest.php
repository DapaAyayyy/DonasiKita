<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PengelolaBackofficeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::disableForeignKeyConstraints();
        foreach (['feedback', 'laporan', 'donasi', 'kampanye_sosial', 'metode_pembayaran', 'donatur', 'penerima', 'pengelola'] as $table) {
            Schema::dropIfExists($table);
        }
        Schema::enableForeignKeyConstraints();

        Schema::create('pengelola', function (Blueprint $table): void {
            $table->increments('id_pengelola');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('no_hp')->nullable();
            $table->string('role')->default('super_admin');
            $table->string('status')->default('aktif');
        });

        Schema::create('donatur', function (Blueprint $table): void {
            $table->increments('id_donatur');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
        });

        Schema::create('penerima', function (Blueprint $table): void {
            $table->increments('id_penerima');
            $table->string('nama');
            $table->string('kategori_penerima')->nullable();
            $table->text('alamat');
            $table->string('no_hp')->nullable();
            $table->text('deskripsi_kebutuhan')->nullable();
        });

        Schema::create('kampanye_sosial', function (Blueprint $table): void {
            $table->increments('id_kampanye');
            $table->integer('id_pengelola');
            $table->integer('id_penerima');
            $table->string('judul_kampanye');
            $table->text('deskripsi');
            $table->decimal('target_donasi', 15, 2);
            $table->decimal('terkumpul', 15, 2)->default(0);
            $table->string('foto_sampul')->nullable();
            $table->dateTime('tanggal_dibuat')->nullable();
            $table->date('deadline');
            $table->string('status')->default('pending');
        });

        Schema::create('metode_pembayaran', function (Blueprint $table): void {
            $table->increments('id_metode');
            $table->string('nama_metode');
            $table->string('nomor_akun');
            $table->string('status_aktif')->default('aktif');
        });

        Schema::create('donasi', function (Blueprint $table): void {
            $table->increments('id_donasi');
            $table->integer('id_donatur');
            $table->integer('id_kampanye');
            $table->integer('id_metode')->nullable();
            $table->decimal('nominal', 15, 2);
            $table->dateTime('tanggal_donasi')->nullable();
            $table->string('status_donasi')->default('pending');
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->dateTime('paid_at')->nullable();
        });

        Schema::create('laporan', function (Blueprint $table): void {
            $table->increments('id_laporan');
            $table->integer('id_kampanye');
            $table->integer('id_pengelola');
            $table->string('judul_laporan')->nullable();
            $table->text('isi_laporan')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->dateTime('tanggal_dibuat')->nullable();
        });

        Schema::create('feedback', function (Blueprint $table): void {
            $table->increments('id_feedback');
            $table->text('komentar');
            $table->integer('id_donasi')->nullable();
        });

        $this->seedBackofficeData();
    }

    public function test_guest_and_donatur_cannot_open_pengelola_dashboard(): void
    {
        $this->get('/pengelola/dashboard')->assertRedirect('/login');

        $this->withSession([
            'auth_type' => 'donatur',
            'auth_id' => 1,
            'auth_name' => 'Donatur Test',
        ])->get('/pengelola/dashboard')->assertRedirect('/login');
    }

    public function test_pengelola_can_open_dashboard(): void
    {
        $this->withPengelolaSession()
            ->get('/pengelola/dashboard')
            ->assertOk()
            ->assertSee('Dashboard Pengelola')
            ->assertSee('Dana Berhasil');
    }

    public function test_pengelola_sidebar_highlights_only_current_section(): void
    {
        $response = $this->withPengelolaSession()
            ->get('/pengelola/kampanye')
            ->assertOk();

        preg_match('/<nav class="p-4 flex lg:flex-col gap-2 overflow-x-auto">(.*?)<\/nav>/s', $response->getContent(), $matches);

        $this->assertNotEmpty($matches);
        $this->assertSame(1, substr_count($matches[1], 'bg-[#3525cd] text-white'));
        $response->assertSee('Kelola Kampanye');
    }

    public function test_public_campaign_detail_displays_campaign_data(): void
    {
        $this->get('/kampanye/1')
            ->assertOk()
            ->assertSee('Kampanye Test')
            ->assertSee('Deskripsi kampanye')
            ->assertSee('Penerima Test')
            ->assertSee('assets/images/sampul-test.jpg');
    }

    public function test_pengelola_can_update_donation_status_and_recalculate_campaign_total(): void
    {
        $this->withPengelolaSession()
            ->put('/pengelola/donasi/1/status', [
                'status_donasi' => 'berhasil',
            ])
            ->assertSessionHas('success');

        $this->assertSame('berhasil', DB::table('donasi')->where('id_donasi', 1)->value('status_donasi'));
        $this->assertNotNull(DB::table('donasi')->where('id_donasi', 1)->value('paid_at'));
        $this->assertEquals(150000, (float) DB::table('kampanye_sosial')->where('id_kampanye', 1)->value('terkumpul'));
    }

    private function withPengelolaSession(): self
    {
        return $this->withSession([
            'auth_type' => 'pengelola',
            'auth_id' => 1,
            'auth_name' => 'Admin Test',
            'auth_role' => 'super_admin',
        ]);
    }

    private function seedBackofficeData(): void
    {
        DB::table('pengelola')->insert([
            'id_pengelola' => 1,
            'nama' => 'Admin Test',
            'email' => 'admin@example.test',
            'password_hash' => Hash::make('secret123'),
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        DB::table('donatur')->insert([
            'id_donatur' => 1,
            'nama' => 'Donatur Test',
            'email' => 'donatur@example.test',
            'password_hash' => Hash::make('secret123'),
        ]);

        DB::table('penerima')->insert([
            'id_penerima' => 1,
            'nama' => 'Penerima Test',
            'kategori_penerima' => 'Sosial',
            'alamat' => 'Jl. Test',
        ]);

        DB::table('kampanye_sosial')->insert([
            'id_kampanye' => 1,
            'id_pengelola' => 1,
            'id_penerima' => 1,
            'judul_kampanye' => 'Kampanye Test',
            'deskripsi' => 'Deskripsi kampanye',
            'target_donasi' => 1000000,
            'terkumpul' => 50000,
            'foto_sampul' => 'sampul-test.jpg',
            'tanggal_dibuat' => now(),
            'deadline' => now()->addMonth()->toDateString(),
            'status' => 'aktif',
        ]);

        DB::table('metode_pembayaran')->insert([
            'id_metode' => 1,
            'nama_metode' => 'Transfer Test',
            'nomor_akun' => '123',
        ]);

        DB::table('donasi')->insert([
            [
                'id_donasi' => 1,
                'id_donatur' => 1,
                'id_kampanye' => 1,
                'id_metode' => 1,
                'nominal' => 100000,
                'tanggal_donasi' => now(),
                'status_donasi' => 'pending',
                'midtrans_order_id' => 'ORDER-1',
                'midtrans_transaction_id' => null,
                'payment_type' => null,
                'paid_at' => null,
            ],
            [
                'id_donasi' => 2,
                'id_donatur' => 1,
                'id_kampanye' => 1,
                'id_metode' => 1,
                'nominal' => 50000,
                'tanggal_donasi' => now(),
                'status_donasi' => 'berhasil',
                'midtrans_order_id' => null,
                'midtrans_transaction_id' => null,
                'payment_type' => null,
                'paid_at' => now(),
            ],
        ]);
    }
}
