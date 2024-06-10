<?php

namespace App\Helpers;

class TranslateMonth
{
    public static function translate($month)
    {
        $months = [
            'januari' => 'Jan',
            'februari' => 'Feb',
            'maret' => 'Mar',
            'april' => 'Apr',
            'mei' => 'May',
            'juni' => 'Jun',
            'juli' => 'Jul',
            'agustus' => 'Aug',
            'september' => 'Sep',
            'oktober' => 'Oct',
            'november' => 'Nov',
            'desember' => 'Dec',
        ];

        return $months[strtolower($month)];
    }

    public static function monthCode($month)
    {
        $months = [
            '01' => 'januari',
            '02' => 'februari',
            '03' => 'maret',
            '04' => 'april',
            '05' => 'mei',
            '06' => 'juni',
            '07' => 'juli',
            '08' => 'agustus',
            '09' => 'september',
            '10' => 'oktober',
            '11' => 'november',
            '12' => 'desember',
        ];

        return $months[strtolower($month)];
    }
}
