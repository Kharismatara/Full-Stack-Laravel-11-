<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Gunakan relasi 'officeSpaces' dengan withCount
        $cities = City::withCount('officeSpaces')->get();
        return CityResource::collection($cities);
    }

    public function show(City $city)
    {
        // Load relasi 'officeSpaces' dengan nama yang benar
        $city->load(['officeSpaces.city', 'officeSpaces.photos']);
        $city->loadCount('officeSpaces');
        return new CityResource($city);
    }
}