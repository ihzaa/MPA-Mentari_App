<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\category as categoryModel;
use App\Models\item;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        categoryModel::factory()
            ->has(item::factory()->count(5))
            ->count(10)
            ->create();
    }
}
