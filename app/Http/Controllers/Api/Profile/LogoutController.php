<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Traits\JwtToken;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    use JwtToken;

    /*
    * user logout
    */
    public function logout(Request $request)
    {
        $this->apiLogout();

        return responseApi('success', __('api.logout_success'));
    }


    /*
    * token refresh
    */
    public function refresh(Request $request)
    {
       $data = $this->apiRefresh();

        return responseApi('success','', $data);
    }
}
