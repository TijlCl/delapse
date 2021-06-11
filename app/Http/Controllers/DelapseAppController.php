<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DelapseAppController extends Controller
{

    public function downloadAPK()
    {
        $delapseAPK = public_path(). "/Delapse.apk";

        $headers = [
            'Content-Type' => 'application/vnd.android.package-archive',
        ];

        return response()->download($delapseAPK, 'Delapse.apk', $headers);
    }
}
