<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
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
                'key' => 'profile_image_default',
                'value' => 'public/images/settings/profile_image/img_avatar.png',
            ]
        ];
        foreach ($items as $item) {
            \App\Settings::create($item);
        }
    }
}
