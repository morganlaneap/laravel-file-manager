<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'item' => 'site_name',
            'value' => 'LaravelFileManager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
