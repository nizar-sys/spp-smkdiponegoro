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

    public function convertAmountToText($number)
    {
        $number = str_replace(".", "", $number); // Remove dots if exist
        $units = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
            'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
        ];
        $tens = ['', '', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'];
        $scales = ['', 'ribu', 'juta', 'miliar', 'triliun'];

        if ($number == 0) {
            return 'nol';
        }

        $result = '';

        for ($i = 0, $scale = 0; $number > 0; $i += 3, $scale++) {
            $chunk = $number % 1000;
            $number = intval($number / 1000);

            if ($chunk > 0) {
                $result = $this->convertChunk($chunk, $units, $tens) . ' ' . $scales[$scale] . ' ' . $result;
            }
        }

        return trim($result);
    }

    private function convertChunk($number, $units, $tens)
    {
        $result = '';

        if ($number > 99) {
            $result .= $units[intval($number / 100)] . ' ratus ';
            $number %= 100;
        }

        if ($number > 19) {
            $result .= $tens[intval($number / 10)] . ' ';
            $number %= 10;
        }

        if ($number > 0) {
            $result .= $units[$number] . ' ';
        }

        return trim($result);
    }
}
