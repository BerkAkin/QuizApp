<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Logla($tur, $islem, $ekParam = "")
    {
        $log = new Log;
        $log->IslemTuru = $tur;
        if ($ekParam == "") {
            $log->Islem = $islem;
        } else {
            $log->Islem = $islem . " (" . $ekParam . ")";
        }

        $log->islemiYapan = auth()->user()->name;
        $log->IpAdresi = request()->ip();
        $log->save();
    }
}