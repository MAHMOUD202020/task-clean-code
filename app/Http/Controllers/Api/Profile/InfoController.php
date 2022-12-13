<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Traits\JwtToken;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    use JwtToken;

    /*
    * Get profile information for user
    */
    public function me(Request $request)
    {
        $info = auth()->user();

        return responseApi('success', '', $info);
    }

}
