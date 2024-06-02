<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TableOrderPrintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('tableorderprint')->insert([
                'id_user' => $users[array_rand($users)],
                'nama' => Str::random(10),
                'kontak' => '08123456789' . $i,
                'file_name' => 'file_' . $i . '.stl',
                'material' => 'PLA',
                'status' => 'waiting',
                'tanggal_pesan' => Carbon::now()->subDays(rand(1, 30))->toDateString(),
                'jam_pesan' => Carbon::now()->subHours(rand(1, 12))->toTimeString(),
                'file_resi' => null,
                'harga' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
