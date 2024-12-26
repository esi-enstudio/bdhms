<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user
 * @property mixed $id
 */
class RsoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'          => new UserResource($this->user),
            'id'            => $this->id,
            'code'          => $this->code,
            'number'        => $this->number,
            'pool_number'   => $this->pool_number,
            'status'        => $this->status,
        ];
    }
}
