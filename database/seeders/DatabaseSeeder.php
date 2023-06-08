<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $timestamp = Carbon::now();
        DB::table('users')->insert([
            [ 
                'name' => 'Ruinze Malinao',
                'email' => 'ruinzemalinao@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123123123'),
                'approval_status' => 'Approved',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Mark Restauro',
                'email' => 'markrestauro@gmail.com',
                'role' => 'viewer',
                'password' => bcrypt('123123123'),
                'approval_status' => 'Approved',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);
    }
}
