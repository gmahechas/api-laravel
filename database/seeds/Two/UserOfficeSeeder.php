<?php

use Illuminate\Database\Seeder;
use App\Models\Two\UserOffice;

class UserOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserOffice::truncate();
        UserOffice::flushEventListeners();
        UserOffice::create([
        	'user_office_status' => '1',
        	'user_id' => 1,
        	'office_id' => 1
        ]);
        UserOffice::create([
        	'user_office_status' => '1',
        	'user_id' => 1,
        	'office_id' => 2
        ]);
    }
}