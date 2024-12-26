<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user
 * @property mixed $id
 */
class RetailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'      => new UserResource($this->user),
            'rso'       => new RsoResource($this->rso),
            'house'     => new DdHouseResource($this->ddHouse),
            'id'        => $this->id,
            'code'      => $this->code,
            'name'      => $this->name,
            'number'    => $this->number,
            'enabled'   => $this->enabled,
            'sso'       => $this->sso,
        ];
    }
}
