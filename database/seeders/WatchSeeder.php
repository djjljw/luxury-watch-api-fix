<?php

namespace Database\Seeders;

use App\Models\Watch;
use Illuminate\Database\Seeder;

class WatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $watches = [
            [
                'nama' => 'Rolex Submariner Date',
                'brand' => 'Rolex',
                'harga' => 250000000,
                'tahun_rilis' => 2023,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Oystersteel',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
            ],
            [
                'nama' => 'Patek Philippe Nautilus 5711/1R',
                'brand' => 'Patek Philippe',
                'harga' => 1450000000,
                'tahun_rilis' => 2022,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Rose Gold 18k',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1547996160-71dfa470d475',
            ],
            [
                'nama' => 'Audemars Piguet Royal Oak Jumbo Extra-Thin',
                'brand' => 'Audemars Piguet',
                'harga' => 980000000,
                'tahun_rilis' => 2023,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Titanium & Platinum',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9',
            ],
            [
                'nama' => 'Richard Mille RM 11-03 Flyback Chronograph',
                'brand' => 'Richard Mille',
                'harga' => 3850000000,
                'tahun_rilis' => 2021,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Carbon TPT',
                'status' => 'terjual',
                'foto' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d',
            ],
            [
                'nama' => 'Omega Speedmaster Professional Moonwatch',
                'brand' => 'Omega',
                'harga' => 115000000,
                'tahun_rilis' => 2024,
                'tipe_gerakan' => 'Manual',
                'material' => 'Stainless Steel',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1508057198894-247b23fe5ade',
            ],
            [
                'nama' => 'Cartier Santos de Cartier Large',
                'brand' => 'Cartier',
                'harga' => 165000000,
                'tahun_rilis' => 2023,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Yellow Gold 18k & Steel',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1533139502658-0198f920d8e8',
            ],
            [
                'nama' => 'Vacheron Constantin Overseas Dual Time',
                'brand' => 'Vacheron Constantin',
                'harga' => 480000000,
                'tahun_rilis' => 2022,
                'tipe_gerakan' => 'Automatic',
                'material' => 'Stainless Steel',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1526045612212-70caf35c14df',
            ],
            [
                'nama' => 'Grand Seiko Snowflake Spring Drive SBGA211',
                'brand' => 'Grand Seiko',
                'harga' => 95000000,
                'tahun_rilis' => 2023,
                'tipe_gerakan' => 'Quartz',
                'material' => 'High-intensity Titanium',
                'status' => 'tersedia',
                'foto' => 'https://images.unsplash.com/photo-1542496658-e33a6d0d50f6',
            ],
        ];

        foreach ($watches as $watch) {
            Watch::create($watch);
        }
    }
}
