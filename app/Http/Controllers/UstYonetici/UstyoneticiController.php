<?php

namespace App\Http\Controllers\UstYonetici;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class UstyoneticiController extends Controller
{
    public function loglarıGoster()
    {
        parent::Logla('Yönetici', 'Yönetici Log Sayfasına Girildi');
        return view('ustYonetici.loglar');
    }



    public function LogYonetici()
    {
        $log = Log::where('IslemTuru', 'Yönetici')->get();
        return view('ustYonetici.loglar', compact('log'));
    }




    public function LogDashboard()
    {
        $log = Log::where('IslemTuru', 'Dashboard')->get();
        return view('ustYonetici.loglar', compact('log'));
    }



    public function LogMesajlar()
    {
        $log = Log::where('IslemTuru', 'Mesajlar')->get();
        return view('ustYonetici.loglar', compact('log'));
    }



    public function LogSinavlar()
    {
        $log = Log::where('IslemTuru', 'Sınavlar')->get();
        return view('ustYonetici.loglar', compact('log'));
    }




    public function LogNotlar()
    {
        $log = Log::where('IslemTuru', 'Notlar')->get();
        return view('ustYonetici.loglar', compact('log'));
    }




    public function LogKayitlar()
    {
        $log = Log::where('IslemTuru', 'Kayıt')->get();
        return view('ustYonetici.loglar', compact('log'));
    }




    public function LogOgrKabul()
    {
        $log = Log::where('IslemTuru', 'Öğrenci Kabul')->get();
        return view('ustYonetici.loglar', compact('log'));
    }


    public function LogOgrSilme()
    {
        $log = Log::where('IslemTuru', 'Öğrenci Silme')->get();
        return view('ustYonetici.loglar', compact('log'));
    }

    public function LogSinavGirilme()
    {
        $log = Log::where('IslemTuru', 'Sınava Girildi')->get();
        return view('ustYonetici.loglar', compact('log'));
    }
}