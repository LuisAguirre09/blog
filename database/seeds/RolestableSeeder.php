<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolestableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class,3)->create();
    }
}
