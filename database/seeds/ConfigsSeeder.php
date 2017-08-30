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
        Config::firstOrNew(array(
            'item' => 'site_name',
            'value' => 'LaravelFileManager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ))->save();

        Config::firstOrNew(array(
            'item' => 'show_footer_message',
            'value' => 'true',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ))->save();

        /*DB::table('configs')->firstOrNew([
            'item' => 'site_name',
            'value' => 'LaravelFileManager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('configs')->firstOrNew([
            'item' => 'show_footer_message',
            'value' => 'true',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);*/
    }
}
