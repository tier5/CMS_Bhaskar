<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('clients')->insert([
            'session_id' => 'xxx',
            'ip'=> 'xxx',
            'user_name'=> 'Admin',
            'browser_name'=>'xxx',
            'browser_platform'=>'xxx',
            'page'=>'xxx',
            ]);
    }
}
