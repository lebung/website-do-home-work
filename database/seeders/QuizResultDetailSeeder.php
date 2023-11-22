<?php

namespace Database\Seeders;

use App\Models\QuizResultDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizResultDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizResultDetail::factory(10)->create();
    }
}
