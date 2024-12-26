<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @property mixed $ddHouse
 * @property mixed $user
 * @property mixed $rso
 * @property mixed $retailer
 * @property mixed $id
 * @property mixed $sim_serial
 * @property mixed $balance
 * @property mixed $number
 * @property mixed $reason
 * @property mixed $status
 * @property mixed $remarks
 * @property mixed $description
 * @property mixed $supervisor
 */
class ItopReplaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'house'         => new DdHouseResource($this->ddHouse),
            'user'          => new UserResource($this->user),
            'rso'           => new RsoResource($this->rso),
            'retailer'      => new RetailerResource($this->retailer),
            'id'            => $this->id,
            'supervisor'    => User::firstWhere('id', $this->supervisor),
            'sim_serial'    => $this->sim_serial,
            'balance'       => $this->balance,
            'number'        => $this->number,
            'reason'        => $this->reason,
            'status'        => Str::title($this->status),
            'remarks'       => Str::title($this->remarks),
            'description'   => $this->description,
        ];
    }
}
