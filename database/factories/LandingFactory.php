<?php

namespace Database\Factories;

use App\Models\landing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Landing>
 */
class LandingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = landing::class;

    public function definition(): array
    {
        return [
            'location' => 'Jl. Babarsari Kotak POB 6101/YKKB, Ngentak, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
            'telp' => '081234567890', // Ganti dengan nomor telepon yang diinginkan
        ];
    }
}
