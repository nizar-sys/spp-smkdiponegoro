<?php

namespace App\Http\Controllers;

use App\Helpers\TranslateMonth;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function home(Request $request)
    {
        $monthYear = $request->input('monthYear');
        $yearSelected = $monthYear ? explode('-', $monthYear)[0] : date('Y');

        // Fetch SPP data for the current year and group by student name
        $spps = Spp::with('onePembayaran')
            ->whereTahun($yearSelected)
            ->orderByDesc('id')
            ->get()
            ->groupBy('siswa.nama');

        // Get the list of students
        $students = Siswa::when($request->filled('nis'), function ($query) use ($request) {
            return $query->where('nis', $request->nis);
        })->get();

        // Prepare the months array
        $months = $monthYear ? [TranslateMonth::monthCode(explode('-', $monthYear)[1])] : [TranslateMonth::monthCode(date('m'))];

        // Initialize the sppsByMonth array
        $sppsByMonth = [];
        foreach ($spps as $namaSiswa => $dataSpp) {
            foreach ($months as $month) {
                $sppBulanIni = $dataSpp->firstWhere('bulan', $month);
                $sppsByMonth[$namaSiswa][$month] = $sppBulanIni ? $sppBulanIni->status : null;
            }
        }

        // Fill in missing payment data with a button
        foreach ($students as $student) {
            foreach ($months as $month) {
                if (!isset($sppsByMonth[$student->nama][$month])) {
                    $sppsByMonth[$student->nama][$month] = '<div class="text-dark">' . ucfirst($month) . ' ' . $yearSelected . '</div>';
                }
            }
        }

        return view('welcome', compact('spps', 'months', 'sppsByMonth', 'students', 'yearSelected'));
    }
}
