<?php

namespace App\Traits;

trait JwtToken
{

    /*
     * create JWT token
     */
    protected function createNewToken($token){
        return [
            'token' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
            'user' => auth()->user(),
        ];
    }


    /*
     * user login account
     */
    protected function loginAccount($request){

        $login = auth()->attempt([
            'phone' => $request->phone,
            'password' => $request->password
        ]);

        if ($login)
            return $this->createNewToken($login);

        return false;
    }

    /*
    * user logout
    */
    public function apiLogout(){

        auth()->logout();

        return true;
    }

    /*
    * token refresh
    */
    public function apiRefresh()
    {
        $data = $this->createNewToken(auth()->refresh());

        return $data;
    }
}
