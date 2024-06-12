<?php

namespace App\Http\Controllers;

use App\Helpers\TranslateMonth;
use App\Models\Spp;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateSpp;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Dd;
use Barryvdh\DomPDF\Facade\Pdf;


class SppController extends Controller
{

    protected $months = [
        // 'januari',
        // 'februari',
        // 'maret',
        // 'april',
        // 'mei',
        // 'juni',
        // 'juli',
        // 'agustus',
        // 'september',
        // 'oktober',
        // 'november',
        // 'desember',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::check() && !Session::has('nis')) {
            return redirect(route('login'))->with('error', 'Silahkan login terlebih dahulu.');
        }

        $monthYear = $request->input('monthYear');
        $yearSelected = $monthYear ? explode('-', $monthYear)[0] : date('Y');

        // Fetch SPP data for the current year and group by student name
        $spps = Spp::with('onePembayaran')
            ->whereTahun($yearSelected)
            ->orderByDesc('id')
            ->get()
            ->groupBy('siswa.nama');

        // Get the list of students
        $students = Siswa::when(Session::has('nis'), function ($query) {
            return $query->where('nis', Session::get('nis'));
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

        return view('dashboard.spps.index', compact('spps', 'months', 'sppsByMonth', 'students', 'yearSelected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Siswa::get(['id', 'kelas_id', 'nama']);
        $daysInThisMonth = Carbon::now()->daysInMonth;

        return view('dashboard.spps.create', compact('students', 'daysInThisMonth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateSpp $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $spp = Spp::create($validated);

        return redirect(route('data-spp.index'))->with('success', 'Spp berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Spp::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spp = Spp::findOrFail($id);
        $students = Siswa::get(['id', 'kelas_id', 'nama']);
        $daysInThisMonth = Carbon::now()->daysInMonth;

        return view('dashboard.spps.edit', compact('spp', 'students', 'daysInThisMonth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateSpp $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $spp = Spp::findOrFail($id);

        if ($validated['tanggal'] == $spp->tanggal && $validated['bulan'] == $spp->bulan && $validated['tahun'] == $spp->tahun && $validated['siswa_id'] == $spp->siswa_id) {
            return back()->with('error', 'Tanggal, bulan, dan tahun yang dipilih sudah tersedia.');
        }

        $spp->update($validated);

        return redirect(route('data-spp.index'))->with('success', 'Spp berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();

        return redirect(route('data-spp.index'))->with('success', 'Spp berhasil dihapus.');
    }

    public function pembayaranView($sppId)
    {
        $spp = Spp::findOrFail($sppId);

        return view('dashboard.spps.pembayaran', compact('spp'));
    }

    public function storePembayaran(Request $request, $sppId)
    {
        $spp = Spp::findOrFail($sppId);
        $spp->update([
            'status' => 'lunas',
            'updated_at' => now()
        ]);
        $pembayaran = Pembayaran::create([
            'petugas_id' => Auth::id(),
            'siswa_id' => $spp->siswa->id,
            'spp_id' => $spp->id,
            'tgl_bayar' => date('Y-m-d'),
            'bulan_dibayar' => $spp->bulan,
            'tahun_dibayar' => $spp->tahun,
            'jumlah_bayar' => (int) $request->jumlah_bayar,
            'created_at' => now()
        ]);

        return redirect(route('data-spp.index'))->with('success', 'Spp berhasil dibayar');
    }

    public function payment(Request $request)
    {
        $payloadSpp = [
            'siswa_id' => $request->siswa_id,
            'nominal' => $request->nominal,
            'tanggal' => date('d'),
            'bulan' => strtolower($request->bulan_dibayar),
            'tahun' => date('Y'),
            'status' => 'lunas',
            'created_at' => now(),
        ];

        $payloadPembayaran = [
            'kd_transaksi' => date('Ymd') . rand(100, 999),
            'petugas_id' => Auth::id(),
            'siswa_id' => $request->siswa_id,
            'tgl_bayar' => date('Y-m-d'),
            'bulan_dibayar' => strtolower($request->bulan_dibayar),
            'tahun_dibayar' => date('Y'),
            'jumlah_bayar' => (int) $request->nominal,
            'created_at' => now(),
        ];

        if ($request->hasFile('bukti_pembayaran')) {
            $fileName = time() . '.' . $request->bukti_pembayaran->extension();
            $payloadPembayaran['bukti_pembayaran'] = $fileName;

            // move file
            $request->bukti_pembayaran->move(public_path('uploads/images'), $fileName);
        }

        $spp = Spp::create($payloadSpp);
        $spp->pembayarans()->updateOrCreate([
            'spp_id' => $spp->id,
        ], $payloadPembayaran);

        return redirect()->back()->with('success', 'Spp berhasil dibayar');
    }

    public function kwitansi($kd_transaksi)
    {
        $pembayaran = Pembayaran::where('kd_transaksi', $kd_transaksi)->first()->load('siswa', 'spp');
        $spp = $pembayaran->spp;

        $pdf = Pdf::loadView('dashboard.spps.kwitansi', compact('pembayaran', 'spp'));
        return $pdf->stream('kwitansi-pembayaran-spp' . $kd_transaksi . '.pdf');
    }

    public function laporanSpp(Request $request)
    {
        $monthYear = $request->input('monthYear');
        $yearSelected = $monthYear ? explode('-', $monthYear)[0] : date('Y');
        $monthSelected = $monthYear ? TranslateMonth::monthCode(explode('-', $monthYear)[1]) : TranslateMonth::monthCode(date('m'));

        // Fetch SPP data for the current year and group by student name
        $spps = Spp::with('onePembayaran')
            ->whereTahun($yearSelected)
            ->orderByDesc('id')
            ->get()
            ->groupBy('siswa.nama');

        // Get the list of students
        $students = Siswa::whereHas('pembayaran', function ($query) use ($yearSelected, $monthSelected) {
            $query->whereNotNull('kd_transaksi')->where('tahun_dibayar', $yearSelected)
                ->where('bulan_dibayar', $monthSelected);
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


        return view('dashboard.spps.laporan-spp', compact('spps', 'months', 'sppsByMonth', 'students', 'yearSelected'));
    }
}
