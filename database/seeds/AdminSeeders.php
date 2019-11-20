<?php

use Illuminate\Database\Seeder;
use App\Leaveinfo;
class AdminSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();
        DB::table('accepted')->truncate();
        DB::table('rejected')->truncate();
        DB::table('pending')->truncate();
        DB::table('notification')->truncate();
        DB::table('leaveinfo')->truncate();


        $authority = Sentinel::registerAndActivate(array(
        'userName' => 'General Manager',
        'email' => 'authority@authority.com',
        'password' => "authority",
            'gender'=>'male',
            'date_of_birth'=>'01/01/1992',
        'fullName' => 'Authority',
        'class' => 'CEO',
        'phoneNo' => '01673641621',
        'image' => 'avatar.jpg',
        'address' => 'Banasree,Dhaka',

    ));

        $admin = Sentinel::registerAndActivate(array(
            'userName' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => "admin",
            'gender'=>'male',
            'date_of_birth'=>'01/01/1992',
            'fullName' => 'Admin',
            'class' => 'Software Engineer',
            'phoneNo' => '01673641621',
            'image' => 'avatar.jpg',
            'address' => 'Banasree,Dhaka',

        ));

        $member = Sentinel::registerAndActivate(array(
            'userName' => 'User',
            'email' => 'user@user.com',
            'password' => "user",
            'gender'=>'male',
            'date_of_birth'=>'01/01/1992',
            'fullName' => 'User',
            'class' => 'SQA',
            'phoneNo' => '01673641621',
            'image' => 'avatar.jpg',
            'address' => 'Banasree,Dhaka',

        ));

        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => array('admin' => 1),
        ]);

        $authorityRole=Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Authority',
            'slug' => 'authority',
        ]);
        $user=Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'User',
            'slug' => 'user',
        ]);


        for($i=1;$i<=3;$i++){
            $data= new Leaveinfo();
            $data->allow_leave = 20;
            $data->user_id = $i;
            $data->remaining_leave = 20;
            $data->save();
        }

        $admin->roles()->attach($adminRole);
        $authority->roles()->attach($authorityRole);
        $member->roles()->attach($user);


        $this->command->info('Admin User created with username admin@admin.com and password admin');
    }

}
