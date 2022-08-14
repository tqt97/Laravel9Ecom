<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at_formatted' => $this->when($this->created_at, function () {
                // return $this->created_at->format('Y-m-d H:i:s');
                return $this->created_at->toDayDateTimeString();
            }),
            // 'updated_at' => $this->updated_at,
        ];
    }
}
