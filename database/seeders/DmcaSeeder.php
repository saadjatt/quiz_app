<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DMCA;

class DmcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DMCA::query()->upsert(["dmca" => "<p>ok</p>"], ["dmca"],["dmca"]);
    }
}
