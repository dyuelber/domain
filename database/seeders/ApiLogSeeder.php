<?php

namespace Database\Seeders;

use App\Models\ApiLog;
use Illuminate\Database\Seeder;

class ApiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiLog::factory(2)->create();
    }
}
