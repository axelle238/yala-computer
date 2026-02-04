<?php

namespace Tests\Feature;

use Tests\TestCase;

class HalamanUtamaTest extends TestCase
{
    /**
     * Test halaman beranda bisa diakses.
     */
    public function test_halaman_beranda_bisa_diakses(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('YALA COMP');
    }

    /**
     * Test halaman katalog bisa diakses.
     */
    public function test_halaman_katalog_bisa_diakses(): void
    {
        $response = $this->get('/katalog');

        $response->assertStatus(200);
        $response->assertSee('Katalog Produk');
    }

    /**
     * Test halaman login admin bisa diakses.
     */
    public function test_halaman_login_admin_bisa_diakses(): void
    {
        $response = $this->get('/masuk');

        $response->assertStatus(200);
        $response->assertSee('Selamat Datang');
    }

    /**
     * Test halaman dashboard admin dilindungi middleware auth.
     */
    public function test_dashboard_admin_dilindungi(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/masuk');
    }
}
