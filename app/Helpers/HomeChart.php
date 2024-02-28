<?php

namespace App\Helpers;

use App\Models\Report;
use App\Models\Revision;

class HomeChart
{
    public static function REPORT()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Report::whereDate('created_at', $dates)->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function REVISION()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Revision::whereDate('created_at', $dates)->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }
}
