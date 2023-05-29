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

    public function LogTumu($tip)
    {
        switch ($tip) {
            case 'yonetici':
                $log = Log::where('IslemTuru', 'Yönetici')->get();
                return view('ustYonetici.loglar', compact('log'));
                break;
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