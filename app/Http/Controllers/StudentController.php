<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLoginSiswa;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    protected $months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

    public function index()
    {
        return view('auth.login-siswa');
    }

    public function login(RequestLoginSiswa $request)
    {
        $validatedPayload = $request->validated();

        Session::put('nisn', $validatedPayload['nisn']);
        Session::put('nis', $validatedPayload['nis']);
        Session::put('level', 'siswa');
        Session::put('login', true);

        $user = Siswa::where('nisn', $validatedPayload['nisn'])->first();
        Session::put('user', $user);

        return redirect(route('dashboard-siswa'))->with('success', 'Selamat Datang ' . $user->nama);
    }

    public function logout()
    {
        Session::flush();
        return redirect(route('login-siswa'))->with('success', 'Berhasil Logout');
    }

    public function dashboard()
    {
        $user = Siswa::where('nisn', Session::get('nisn'))->first();
        return view('dashboard.index', compact('user'));
    }

    public function history()
    {
        $spps = Spp::orderByDesc('id')->whereTahun(date('Y'))->where('siswa_id', Session::get('user')->id)->get()->groupBy('siswa.nama');

        $months = $this->months;
        $students = Siswa::where('nis', Session::get('user')->nis)->get();

        $sppsByMonth = [];
        foreach ($spps as $namaSiswa => $dataSpp) {
            foreach ($months as $month) {
                $sppBulanIni = $dataSpp->where('bulan', $month)->first();
                $sppsByMonth[$namaSiswa][$month] = $sppBulanIni ? $sppBulanIni->status : null;
            }
        }

        // jika ada data sppsByMonth null maka diisi dengan button bayar dengan melooping data $students
        foreach($students as $student){
            foreach($months as $month){
                if(isset($sppsByMonth[$student->nama])&&$sppsByMonth[$student->nama][$month] == null){
                    $sppsByMonth[$student->nama][$month] = '<div class="text-danger">Belum lunas</div>';
                }
            }
        }


        return view('dashboard.spps.index', compact('spps', 'months', 'sppsByMonth', 'students'));
    }
}
