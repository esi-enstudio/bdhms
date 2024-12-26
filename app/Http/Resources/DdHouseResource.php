<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @property mixed $id
 * @property mixed $code
 * @property mixed $name
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $cluster
 * @property mixed $region
 * @property mixed $district
 * @property mixed $thana
 * @property mixed $email
 * @property mixed $disabled_at
 * @property mixed $remarks
 */
class DdHouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => Str::title($this->name),
            'cluster' => Str::upper($this->cluster),
            'region' => Str::title($this->region),
            'district' => Str::title($this->district),
            'thana' => Str::title($this->thana),
            'email' => $this->email,
            'address' => $this->address,
            'proprietor_name' => $this->proprietor_name,
            'contact_number' => $this->contact_number,
            'poc_name' => $this->poc_name,
            'poc_number' => $this->poc_number,
            'lifting_date' => $this->lifting_date,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'disabled' => Carbon::parse($this->disabled_at)->toDayDateTimeString(),
            'created' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated' => Carbon::parse($this->updated_at)->toDayDateTimeString(),
        ];
    }
}
