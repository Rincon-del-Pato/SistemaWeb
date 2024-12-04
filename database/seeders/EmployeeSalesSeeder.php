<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('employee_sales')->insert([
            ['employee_id' => 2, 'order_id' => 1, 'sale_amount' => 25.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 2, 'sale_amount' => 15.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 3, 'sale_amount' => 30.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 4, 'sale_amount' => 100.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 5, 'sale_amount' => 50.75, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 6, 'sale_amount' => 20.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 7, 'sale_amount' => 12.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 8, 'sale_amount' => 40.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 9, 'sale_amount' => 75.90, 'sale_date' => Carbon::now()],
            ['employee_id' => 2, 'order_id' => 10, 'sale_amount' => 65.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 11, 'sale_amount' => 35.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 12, 'sale_amount' => 22.30, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 13, 'sale_amount' => 28.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 14, 'sale_amount' => 80.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 15, 'sale_amount' => 45.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 16, 'sale_amount' => 25.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 17, 'sale_amount' => 18.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 18, 'sale_amount' => 60.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 19, 'sale_amount' => 100.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 20, 'sale_amount' => 40.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 21, 'sale_amount' => 50.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 22, 'sale_amount' => 30.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 23, 'sale_amount' => 55.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 24, 'sale_amount' => 90.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 25, 'sale_amount' => 60.30, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 26, 'sale_amount' => 22.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 27, 'sale_amount' => 15.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 28, 'sale_amount' => 70.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 29, 'sale_amount' => 95.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 30, 'sale_amount' => 80.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 31, 'sale_amount' => 38.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 32, 'sale_amount' => 19.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 33, 'sale_amount' => 62.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 34, 'sale_amount' => 110.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 35, 'sale_amount' => 52.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 36, 'sale_amount' => 23.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 37, 'sale_amount' => 20.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 38, 'sale_amount' => 55.30, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 39, 'sale_amount' => 85.70, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 40, 'sale_amount' => 45.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 41, 'sale_amount' => 29.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 42, 'sale_amount' => 27.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 43, 'sale_amount' => 50.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 44, 'sale_amount' => 95.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 45, 'sale_amount' => 63.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 46, 'sale_amount' => 30.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 47, 'sale_amount' => 17.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 48, 'sale_amount' => 80.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 49, 'sale_amount' => 60.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 50, 'sale_amount' => 70.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 51, 'sale_amount' => 45.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 52, 'sale_amount' => 33.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 53, 'sale_amount' => 38.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 54, 'sale_amount' => 75.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 55, 'sale_amount' => 66.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 56, 'sale_amount' => 40.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 57, 'sale_amount' => 28.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 58, 'sale_amount' => 60.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 59, 'sale_amount' => 50.30, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 60, 'sale_amount' => 70.20, 'sale_date' => Carbon::now()],


            
            // ['employee_id' => 1, 'order_id' => 61, 'sale_amount' => 62.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 62, 'sale_amount' => 40.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 63, 'sale_amount' => 55.70, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 64, 'sale_amount' => 85.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 65, 'sale_amount' => 48.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 66, 'sale_amount' => 30.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 67, 'sale_amount' => 21.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 68, 'sale_amount' => 75.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 69, 'sale_amount' => 99.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 70, 'sale_amount' => 65.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 71, 'sale_amount' => 52.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 72, 'sale_amount' => 26.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 73, 'sale_amount' => 43.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 74, 'sale_amount' => 100.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 75, 'sale_amount' => 55.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 76, 'sale_amount' => 24.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 77, 'sale_amount' => 30.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 78, 'sale_amount' => 80.10, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 79, 'sale_amount' => 65.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 1, 'order_id' => 80, 'sale_amount' => 95.30, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 81, 'sale_amount' => 28.60, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 82, 'sale_amount' => 21.20, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 83, 'sale_amount' => 45.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 84, 'sale_amount' => 72.50, 'sale_date' => Carbon::now()],
            // ['employee_id' => 2, 'order_id' => 85, 'sale_amount' => 60.70, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 86, 'sale_amount' => 35.40, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 87, 'sale_amount' => 18.90, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 88, 'sale_amount' => 67.00, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 89, 'sale_amount' => 85.80, 'sale_date' => Carbon::now()],
            // ['employee_id' => 3, 'order_id' => 90, 'sale_amount' => 72.40, 'sale_date' => Carbon::now()],
        ]);
    }
}
