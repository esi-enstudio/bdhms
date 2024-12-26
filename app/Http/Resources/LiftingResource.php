<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $products
 */
class LiftingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'house'     => new DdHouseResource($this->ddHouse),
            'user'      => new UserResource($this->user),
            'products'  => $this->products,
            'itopup'    => $this->itopup,
            'deposit'   => $this->deposit,
            'attempt'   => $this->attempt,
            'created'   => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated'   => Carbon::parse($this->updated_at)->toDayDateTimeString(),
        ];
    }
}
