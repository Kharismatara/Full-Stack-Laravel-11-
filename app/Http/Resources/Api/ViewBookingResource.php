<?php

namespace App\Http\Resources\Api;

use App\Filament\Resources\OfficeSpaceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this-> id,
            'name'=>$this->name,
            'phone_number'=>$this->phone_number,
            'booking_trx_id'=>$this->booking_trx_id,
            'is_pain'=>$this-> is_pain,
            'duration'=>$this->name,
            'total_amount'=>$this-> total_amount,
            'started_at'=>$this->started_at,
            'ended_at'=>$this-> ended_at,
            'officeSpace'=> new OfficeSpaceResource($this->whenLoaded('officeSpace'))
        ];
    }
}