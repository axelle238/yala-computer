<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengguna>
 */
class PenggunaFactory extends Factory
{
    /**
     * Model yang digunakan oleh factory ini.
     *
     * @var string
     */
    protected $model = Pengguna::class;

    /**
     * Password default yang digunakan oleh factory.
     */
    protected static ?string $kataSandi;

    /**
     * Definisikan state default model.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'surel' => fake()->unique()->safeEmail(),
            'surel_diverifikasi_pada' => now(),
            'kata_sandi' => static::$kataSandi ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Menandakan bahwa alamat surel model belum diverifikasi.
     */
    public function belumDiverifikasi(): static
    {
        return $this->state(fn (array $attributes) => [
            'surel_diverifikasi_pada' => null,
        ]);
    }
}
