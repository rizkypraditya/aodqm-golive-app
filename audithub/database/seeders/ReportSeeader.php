<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $reportData = [
            [
            'user_id' => 1,
            'nama_project' => 'Indihome 1',
            'nama' => 'Bagasz',
            'tanggal' => '2003-03-21',
            'xml' => 'blala.xml',
            'maincord' => 'blala.exl',
            'abd' => 'indihome.pdf',
            'valins' => 'indihome.jpg',
            'status' => 'belome afrove',
            'submit_date' => '2003-03-21',
            'approver' => 'yziro',
            ]
        ];

        foreach($reportData as $key => $val){
            Report::create($val);
        }
    }

}
