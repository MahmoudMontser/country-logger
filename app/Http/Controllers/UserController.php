<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\CountryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $retrived_data=['id','name_ar','name_en','description_ar','description_en'];


    public function auth(UserAuthRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = auth()->user()->createToken('Token name')->accessToken;
            return response()->json(['token' => $token,'status'=>true,'msg'=>'auth success'], 200);
        } else {
            return response()->json(['data'=>null,'status'=>false,'msg'=>'wrong credentials'],400);

        }
    }

    public function getCountries(Request $request)
    {
        $countries=Country::get($this->retrived_data);
        CountryRequest::create(
            [
                'callback_url'=>$request->callback_url,
                'request'=>$request->toArray(),
                'ip'=>$request->ip(),
            ]
        );
        return response()->json(['data'=>CountryResource::collection($countries),'status'=>true],200);
    }
}
