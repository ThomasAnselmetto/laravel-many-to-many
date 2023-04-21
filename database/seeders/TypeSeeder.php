<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["Bootstrap", "Tailwind", "Vue", "Laravel", "PHPMyAdmin"];

        foreach($labels as $label) {
            $type = new Type();
            $type->label = $label;
            $type->color = $faker->hexColor();
            $type->save();
    }
}
}