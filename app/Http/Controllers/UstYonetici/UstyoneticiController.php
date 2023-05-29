<?php

namespace App\Http\Controllers\UstYonetici;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Setting;

class UstyoneticiController extends Controller
{

    public function LogTumu($tip)
    {
        switch ($tip) {
            case 'dashboard':
                $log = Log::where('IslemTuru', 'Dashboard')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'mesajlar':
                $log = Log::where('IslemTuru', 'Mesajlar')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'sinavlar':
                $log = Log::where('IslemTuru', 'Sınavlar')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'notlar':
                $log = Log::where('IslemTuru', 'Notlar')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'kayitlar':
                $log = Log::where('IslemTuru', 'Kayıt')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'ogrKabul':
                $log = Log::where('IslemTuru', 'Öğrenci Kabul')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'ogrSilme':
                $log = Log::where('IslemTuru', 'Öğrenci Silme')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'sinavGirilme':
                $log = Log::where('IslemTuru', 'Sınava Girildi')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
            case 'tipDegistir':
                $log = Log::where('IslemTuru', 'Tip Güncelleme')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;

        }
    }
}