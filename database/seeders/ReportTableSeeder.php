<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'mitra_id' => 1,
                'description' => 'Laporan ini bertujuan untuk keuagan',
                'project_title' => 'Laporan Keuangan',
                'status' => 'dikirim',
            ]
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
