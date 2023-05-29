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

    public function Logla($tur, $islem)
    {
        $log = new Log;
        $log->IslemTuru = $tur;
        $log->Islem = $islem;
        $log->islemiYapan = auth()->user()->name;
        $log->IpAdresi = request()->ip();
        $log->save();
    }
}