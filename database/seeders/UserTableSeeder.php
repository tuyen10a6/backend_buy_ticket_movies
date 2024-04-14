<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Tuyển chelsea',
            'email' => 'phamtuyenok2002@gmail.com',
            'password' => bcrypt('tuyen10a6'),
        ]);
    }
}
