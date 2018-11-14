<?php

use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folders')->insert([
            'admin_id'      =>  0,
            'root_id'		=>	0,
        	'parent_id'     =>  0,
        	'name'          =>  'Test Folder'
        ]);
    }
}
