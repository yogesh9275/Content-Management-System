<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VemContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vem_contact')->insert([
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'mo_no' => '1234567890',
                'message' => 'Hello, this is a sample message from John Doe.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'mo_no' => '0987654321',
                'message' => 'Hi, this is another sample message from Jane Smith.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
