<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculty')->insert([
            ['name' => 'John Doe', 'email' => 'john@school.edu', 'department' => 'Science', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('sections')->insert([
            ['section_name' => 'Section A', 'faculty_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['section_name' => 'Section B', 'faculty_id' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('students')->insert([
            ['name' => 'Alice Smith', 'section_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bob Jones', 'section_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Charlie Brown', 'section_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
