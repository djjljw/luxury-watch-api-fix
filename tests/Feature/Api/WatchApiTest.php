<?php

namespace Tests\Feature\Api;

use App\Models\Watch;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WatchApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test GET /api/jam-tangan returns 200 and standard envelope.
     */
    public function test_can_get_all_luxury_watches(): void
    {
        $response = $this->getJson('/api/jam-tangan');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'nama',
                        'brand',
                        'harga',
                        'tahun_rilis',
                        'tipe_gerakan',
                        'material',
                        'status',
                        'foto',
                    ],
                ],
            ])
            ->assertJson([
                'message' => 'Daftar koleksi jam mewah berhasil diambil',
            ]);
    }

    /**
     * Test GET /api/jam-tangan/{id} returns 200 for existing watch.
     */
    public function test_can_get_single_luxury_watch(): void
    {
        $watch = Watch::first();

        $response = $this->getJson("/api/jam-tangan/{$watch->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Detail jam mewah berhasil diambil',
                'data' => [
                    'id' => $watch->id,
                    'nama' => $watch->nama,
                    'brand' => $watch->brand,
                    'harga' => $watch->harga,
                    'tahun_rilis' => $watch->tahun_rilis,
                    'tipe_gerakan' => $watch->tipe_gerakan,
                    'material' => $watch->material,
                    'status' => $watch->status,
                    'foto' => $watch->foto,
                ],
            ]);
    }

    /**
     * Test GET /api/jam-tangan/{id} returns 404 if not found.
     */
    public function test_get_non_existent_watch_returns_404(): void
    {
        $response = $this->getJson('/api/jam-tangan/999999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Data jam mewah tidak ditemukan',
                'data' => null,
            ]);
    }

    /**
     * Test POST /api/jam-tangan creates a new watch with 201 Created.
     */
    public function test_can_create_new_luxury_watch(): void
    {
        $payload = [
            'nama' => 'Patek Philippe Aquanaut 5167A',
            'brand' => 'Patek Philippe',
            'harga' => 750000000,
            'tahun_rilis' => 2024,
            'tipe_gerakan' => 'Automatic',
            'material' => 'Stainless Steel',
            'status' => 'tersedia',
            'foto' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
        ];

        $response = $this->postJson('/api/jam-tangan', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Data jam mewah berhasil ditambahkan',
                'data' => [
                    'nama' => 'Patek Philippe Aquanaut 5167A',
                    'brand' => 'Patek Philippe',
                    'harga' => 750000000,
                    'tipe_gerakan' => 'Automatic',
                ],
            ]);

        $this->assertDatabaseHas('koleksi_jam', [
            'nama' => 'Patek Philippe Aquanaut 5167A',
            'brand' => 'Patek Philippe',
        ]);
    }

    /**
     * Test POST /api/jam-tangan fails validation with 422 if fields are missing or invalid.
     */
    public function test_create_watch_fails_validation(): void
    {
        $response = $this->postJson('/api/jam-tangan', [
            'nama' => '',
            'brand' => '',
            'tipe_gerakan' => 'Solar', // Invalid enum
            'status' => 'hilang', // Invalid enum
            'foto' => 'bukan-url', // Invalid url
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'nama',
                'brand',
                'harga',
                'tahun_rilis',
                'tipe_gerakan',
                'material',
                'status',
                'foto',
            ]);
    }

    /**
     * Test PUT /api/jam-tangan/{id} updates watch data with 200 OK.
     */
    public function test_can_update_luxury_watch_via_put(): void
    {
        $watch = Watch::first();

        $updatePayload = [
            'nama' => 'Rolex Submariner Date - Ceramic Bezel',
            'brand' => 'Rolex',
            'harga' => 265000000,
            'tahun_rilis' => 2023,
            'tipe_gerakan' => 'Automatic',
            'material' => 'Oystersteel 904L',
            'status' => 'terjual',
            'foto' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
        ];

        $response = $this->putJson("/api/jam-tangan/{$watch->id}", $updatePayload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Data jam mewah berhasil diperbarui',
                'data' => [
                    'id' => $watch->id,
                    'nama' => 'Rolex Submariner Date - Ceramic Bezel',
                    'harga' => 265000000,
                    'status' => 'terjual',
                ],
            ]);

        $this->assertDatabaseHas('koleksi_jam', [
            'id' => $watch->id,
            'nama' => 'Rolex Submariner Date - Ceramic Bezel',
            'status' => 'terjual',
        ]);
    }

    /**
     * Test PATCH /api/jam-tangan/{id} partially updates watch with 200 OK.
     */
    public function test_can_partially_update_luxury_watch_via_patch(): void
    {
        $watch = Watch::first();

        $response = $this->patchJson("/api/jam-tangan/{$watch->id}", [
            'status' => 'terjual',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Data jam mewah berhasil diperbarui',
                'data' => [
                    'id' => $watch->id,
                    'status' => 'terjual',
                ],
            ]);
    }

    /**
     * Test DELETE /api/jam-tangan/{id} deletes watch with 200 OK.
     */
    public function test_can_delete_luxury_watch(): void
    {
        $watch = Watch::factory()->create([
            'nama' => 'Temp Watch to Delete',
            'brand' => 'Temp Brand',
            'harga' => 100000000,
            'tahun_rilis' => 2020,
            'tipe_gerakan' => 'Quartz',
            'material' => 'Steel',
            'status' => 'tersedia',
            'foto' => 'https://example.com/watch.jpg',
        ]);

        $response = $this->deleteJson("/api/jam-tangan/{$watch->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Data jam mewah berhasil dihapus',
                'data' => null,
            ]);

        $this->assertDatabaseMissing('koleksi_jam', [
            'id' => $watch->id,
        ]);
    }

    /**
     * Test Scramble documentation route /docs/api returns 200 OK.
     */
    public function test_scramble_docs_ui_is_accessible(): void
    {
        $response = $this->get('/docs/api');

        $response->assertStatus(200);
    }

    /**
     * Test Scramble openapi json route /docs/api.json returns 200 OK.
     */
    public function test_scramble_docs_json_is_accessible(): void
    {
        $response = $this->get('/docs/api.json');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'openapi',
                'info',
                'paths',
            ]);
    }
}
