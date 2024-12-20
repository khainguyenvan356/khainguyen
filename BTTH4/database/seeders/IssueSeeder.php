<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\Computer;
use Faker\Factory as Faker;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách các ID của bảng computers để đảm bảo khóa ngoại hợp lệ
        $computerIds = Computer::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) { // Sinh 50 bản ghi mẫu
            Issue::create([
                'computer_id' => $faker->randomElement($computerIds), // Lấy một ID máy tính hợp lệ
                'reported_by' => $faker->name(), // Người báo cáo sự cố
                'reported_date' => $faker->dateTimeBetween('-1 year', 'now'), // Thời gian báo cáo
                'description' => $faker->sentence(10), // Mô tả chi tiết vấn đề
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']), // Mức độ sự cố
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']), // Trạng thái hiện tại
            ]);
        }
    }
}
