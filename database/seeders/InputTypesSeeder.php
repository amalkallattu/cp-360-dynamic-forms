<?php

namespace Database\Seeders;

use App\Models\InputType;
use Illuminate\Database\Seeder;

class InputTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            [
                'name' => 'Text Box',
                'slug' => 'text-box',
            ],
            [
                'name' => 'Number',
                'slug' => 'number',
            ],
            [
                'name' => 'Select Box',
                'slug' => 'select-box',
            ]

        ];
        InputType::insert($inputs);
    }
}
