<?php

namespace Database\Seeders;

use App\Models\item as ModelsItem;
use Illuminate\Database\Seeder;

class item extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsItem::factory()->count(50)->make();
    }
}
