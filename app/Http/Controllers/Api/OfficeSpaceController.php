<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\OfficeSpaceResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource as ApiOfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
    public function index(){
        $officeSpaces = OfficeSpace::with(['city'])->get();
        return ApiOfficeSpaceResource::collection($officeSpaces);
    }
    public function show(OfficeSpace $officeSpace){
        $officeSpace->load(['city', 'photos', 'benefits']);
        return new ApiOfficeSpaceResource($officeSpace);
    }

}