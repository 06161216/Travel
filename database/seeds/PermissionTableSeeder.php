<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                // id = 1
                'name' => '体験者',
            ],
            [
                // id = 2
                'name' => '提供者',
            ]
        ]);
    }
}
