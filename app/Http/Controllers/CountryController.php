<?php

namespace App\Http\Controllers;

use App\Enum\LogTypeEnum;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\Log;
use Illuminate\Http\Request;


class CountryController extends Controller
{
    public $retrived_data=['id','name_ar','name_en','description_ar','description_en'];
    public function index(Request $request)
    {
        $countries=Country::with('logs')->get($this->retrived_data);
        return response()->json(['data'=>CountryResource::collection($countries),'status'=>true],200);

    }
    public function store(CountryStoreRequest $request)
    {
        $data=$request->validated();

        $country=Country::create($data);
        if ($country)
        {
            $country->logs()->create(
                [
                    'type'=>LogTypeEnum::Create->value,
                    'new_data'=>CountryResource::make($country)->toResponse($request)->getData()->data,
                    'old_data'=>null,
                ]
            );
            return response()->json(['data'=>CountryResource::make($country),'status'=>true],200);
        }


        return response()->json(['data'=>null,'status'=>false],400);

    }
    public function update(CountryUpdateRequest $request,Country $country)
    {
        $data=$request->validated();
        $old_data=CountryResource::make($country)->toResponse($request)->getData()->data;

        $is_updated=$country->update($data);
        if ($is_updated)
        {

            $country->logs()->create(
                [
                    'type'=>LogTypeEnum::Update->value,
                    'new_data'=>CountryResource::make($country->fresh())->toResponse($request)->getData()->data,
                    'old_data'=>$old_data,
                ]
            );

            return response()->json(['data'=>CountryResource::make($country),'status'=>true],200);
        }


        return response()->json(['data'=>null,'status'=>false],400);
    }
    public function destroy(Country $country)
    {
        $is_deleted=$country->delete();
        if ($is_deleted)
        {
            return response()->json(['data'=>null,'status'=>true],200);
        }

        return response()->json(['data'=>null,'status'=>false],400);
    }
    public function show(Country $country)
    {
        return response()->json(['data'=>CountryResource::make($country->load('logs')),'status'=>true],200);
    }




}
