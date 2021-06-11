<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DelapseAppController extends Controller
{

    public function downloadAPK()
    {
        $delapseAPK = public_path(). "/Delapse.apk";

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($delapseAPK, 'Delapse.apk', $headers);
    }
}
