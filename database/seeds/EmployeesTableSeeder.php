<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // to run: php artisan db:seed
        Employee::create([
            'firstname'  => 'First Name',
            'lastname'   => 'Last Name',
            'position'   => 'Web Developer',
            'birth_date' => '1995-01-01'
        ]);
    }
}
