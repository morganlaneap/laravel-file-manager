<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Config;
class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Config::where('id', 1)->exists()) {
            Config::firstOrCreate(array(
                'id' => 1,
                'item' => 'site_name',
                'value' => 'LaravelFileManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ))->save();
        }


        if (!Config::where('id', 2)->exists()) {
            Config::firstOrCreate(array(
                'id' => 2,
                'item' => 'show_footer_message',
                'value' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ))->save();
        }

        if (!Config::where('id', 1)->exists()) {
            Config::firstOrCreate(array(
                'id' => 3,
                'item' => 'footer_message',
                'value' => 'LaravelFileManager by Morgan Lane',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ))->save();
        }
    }
}
