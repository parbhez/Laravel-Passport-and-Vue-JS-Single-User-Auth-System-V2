<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_name' => $this->category_name,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'status_text' => $this->statuses($this->status),
            'status_badge' => $this->statusBadge($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

     /**
     * get status name
     */
    protected function statuses($status)
    {
        return [
            '1' => 'Active',
            '0' => 'Inactive',
        ][$status];
    }

    /**
     * get status bg
     */
    protected function statusBadge($status)
    {
        return [
            '1' => 'badge badge-success',
            '0' => 'badge badge-secondary',
        ][$status];
    }
}
