<?php

use Illuminate\Database\Seeder;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$uuid = Uuid::uuid1();

    	\App\Models\Member::create([
    		'id' => $uuid->toString(),
    		'first_name' => 'Nhat',
    		'last_name' =>	'Pham',
    		'role' =>	'administrator',
    		'email' =>	'nguoicodon@developer.com',
    		'password' => \Hash::make('!@#anhkin12#@!'),
    		'phone' =>	'0905483996',
    		'avatar' =>	'http://eva-img.24hstatic.com/upload/1-2016/images/2016-03-19/ro-ri-hinh-anh-hiem-hoi-trong-dam-cuoi-kim-ha-neul-6-1458380316-width471height600.jpg',
    	]);
    }
}
