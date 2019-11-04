<?php

use Illuminate\Database\Seeder;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items = [
            [
                'type_name' => 'Super Admin',
            ],
            [
                'type_name' => 'Admin',
            ],
            [
                'type_name' => 'Student',
            ],
            [
                'type_name' => 'Company',
            ],
            [
                'type_name' => 'Organisation',
            ]
        ];
        foreach ($items as $item) {
            \App\UserTypes::create($item);
        }
    }

}
