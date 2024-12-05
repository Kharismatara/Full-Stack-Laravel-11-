<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::withCount('officeSpace')->get();
        return CityResource::collection($cities);
    }

    public function show(City $city){
        $city->load(['officeSpace.city', 'officeSpace.photos']);
        $city->loadCount('officeSpaces');
        return new CityResource($city);
    }
}