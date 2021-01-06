<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'due_date' => $this->due_date,
            'is_completed' => $this->is_completed,
            'project' => new ProjectResource($this->project),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
