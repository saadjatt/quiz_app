<?php

namespace Database\Seeders;

use App\Models\Guarantee100;
use Illuminate\Database\Seeder;

class Guarantee extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guarantee100::query()->upsert(["guarantee" => "<p>ok</p>"], ["guarantee"],["guarantee"]);
    }
}
