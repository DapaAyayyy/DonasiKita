<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_kebijakan_privasi_page_is_accessible(): void
    {
        $this->get('/kebijakan-privasi')
            ->assertOk()
            ->assertSee('Kebijakan Privasi DonasiKita')
            ->assertSee('Midtrans');
    }

    public function test_syarat_ketentuan_page_is_accessible(): void
    {
        $this->get('/syarat-ketentuan')
            ->assertOk()
            ->assertSee('Syarat & Ketentuan DonasiKita', false)
            ->assertSee('Rp10.000');
    }

    public function test_existing_footer_information_pages_are_accessible(): void
    {
        $this->get('/tentang-kami')
            ->assertOk()
            ->assertSee('Tentang Kami');

        $this->get('/hubungi-kami')
            ->assertOk()
            ->assertSee('Hubungi Kami');
    }

    public function test_footer_links_point_to_legal_pages(): void
    {
        $this->get('/kebijakan-privasi')
            ->assertOk()
            ->assertSee('/kebijakan-privasi')
            ->assertSee('/syarat-ketentuan');
    }
}
