<?php

namespace Database\Seeders;

use App\Models\WargaModel;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WargaModel::query()->create([
            'nama_lengkap'  => 'Abi Manyu',
            'gender'        => 'L',
            'tgl_lahir'     => '2000-02-12',
            'alamat'        => 'Jl. Adisucipto Gg. Mailamah No. Aa7',
            'lokasi'        => '-0.049971091974246505, 109.36056231883762',
            'pengguna_id'   => 1
        ]);
    }
}
