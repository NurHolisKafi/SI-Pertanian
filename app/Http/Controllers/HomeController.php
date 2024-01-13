<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $today;

    public function __construct()
    {
        $this->today = today();
    }

    function index(): View
    {
        $news = News::orderBy('tanggal_posting', 'desc')->limit(6)->get();
        return view('page.home.index', ['news' => $news]);
    }

    function news(): View
    {
        $news = News::select('id_berita', 'judul', 'thumbnail', 'tanggal_posting')->orderBy('tanggal_posting', 'DESC')->paginate(8);
        foreach ($news as $key) {
            $selisih_waktu = $this->today->diffForHumans($key->tanggal_posting);
            $key['tanggal_posting'] = $this->translateWaktu($selisih_waktu);
        }
        return view('page.home.news', ['news' => $news]);
    }

    function budidaya(): View
    {
        $budidaya = Budidaya::join('tanaman', 'tanaman.id_tanaman', 'budidaya.id_tanaman')
            ->select('id', 'tanaman.nama', 'thumbnail')->paginate(20);
        return view('page.home.budidaya', compact('budidaya'));
    }

    function contact(): View
    {
        return view('page.home.contact');
    }

    function about(): View
    {
        return view('page.home.about');
    }

    function news_detail($id): View
    {
        $news_detail = News::where('id_berita', $id)->first();
        $tanggal_posting = Carbon::parse($news_detail['tanggal_posting']);
        $news_detail['tanggal_posting'] = $tanggal_posting->locale('id')->translatedFormat('l, j F Y');
        $related_articel = News::whereNot('id_berita', $id)->limit(5)->get();
        foreach ($related_articel as $key) {
            $selisih_waktu = $this->today->diffForHumans($key->tanggal_posting);
            $key['tanggal_posting'] = $this->translateWaktu($selisih_waktu);
        }
        return view('page.home.news-detail', ['detail' => $news_detail, 'related_articel' => $related_articel]);
    }

    function budidaya_detail($id): View
    {
        $data = Budidaya::with('tanaman')->find($id);
        return view('page.home.detail-budidaya', compact('data'));
    }

    function hpt_detail($id): View
    {
        return view('page.home.news-detail');
    }

    function login_umum(): View
    {
        return view('page.home.login-umum');
    }

    function login_petani(): View
    {
        return view('page.home.login-petani');
    }

    function register_umum(): View
    {
        return view('page.home.register');
    }

    function register_petani(): View
    {
        return view('page.home.register_petani');
    }

    function translateWaktu($param)
    {
        $translation = [
            'before' => 'sebelumnya',
            'ago' => 'yang lalu',
            'after' => 'yang lalu',
            'from now' => 'dari sekarang',
            'years' => 'tahun',
            'year' => 'tahun',
            'month' => 'bulan',
            'months' => 'bulan',
            'week' => 'minggu',
            'weeks' => 'minggu',
            'days' => 'hari',
            'day' => 'hari',
            'hour' => 'jam',
            'hours' => 'jam',
            'minute' => 'menit',
            'minutes' => 'menit',
            'second' => 'detik',
            'seconds' => 'detik',
        ];

        return str_replace(array_keys($translation), array_values($translation), $param);
    }
}
