<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @property mixed $ddHouse
 * @property mixed $user
 * @property mixed $rso
 * @property mixed $retailer
 * @property mixed $id
 * @property mixed $supervisor
 * @property mixed $for
 * @property mixed $type
 * @property mixed $name
 * @property mixed $month
 * @property mixed $amount
 * @property mixed $date
 * @property mixed $description
 * @property mixed $remarks
 * @property mixed $status
 * @property mixed $receive_date
 */
class CommissionResource extends JsonResource
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
            'supervisor'    => User::firstWhere('id', $this->supervisor),
            'id'            => $this->id,
            'for'           => $this->for,
            'type'          => Str::title($this->type),
            'name'          => $this->name,
            'month'         => Carbon::parse($this->month)->format('M Y'),
            'amount'        => $this->amount,
            'receive_date'  => Carbon::parse($this->receive_date)->toFormattedDayDateString(),
            'description'   => $this->description,
            'remarks'       => Str::title($this->remarks),
            'status'        => Str::title($this->status),
        ];
    }
}
