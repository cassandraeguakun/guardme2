<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Account\Http\Resources\RoleResource;

class ApplicantsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $bid_amount = null;
        $bid_date = null;

        if($this->pivot){
            $bid_amount = $this->pivot->bid;
            $bid_date = $this->pivot->bid_at;
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'registeredAt' => $this->registered_date->format('Y-m-d'),
            'bid' => $bid_amount,
            'bid_date' => $bid_date,
        ];
    }

    public static function collection($resource, array $additional_data = []){

        // TODO: Change the auto-generated stub
        return parent::collection($resource)->additional($additional_data);
    }
}
