<?php

namespace Database\Seeders;

use App\Models\category as ModelsCategory;
use App\Models\item;
use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsCategory::factory()
            ->has(item::factory()->count(5))
            ->count(10)
            ->create();
    }
}
