<?php

namespace App\Repository\Apis;

class UserApi extends Api{

    public function api($user){

        return [
        	"id" => $user->id,
            'systemName' => $user->first_name .' '.$user->last_name,
            'email' => $user->email,
            'role' => $user->role_id
            //'token' => $user->api_token,
            //'zoho_user_id' => $user->user_zoho_crm_id
        ];

    }

}