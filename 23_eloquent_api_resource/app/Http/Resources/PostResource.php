<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => url("/api/post/$this->id"),
            'content' => $this->when($request->route()->uri == "api/post/{post}",$this->content),
            'categories' => CategoryPostResource::collection($this->whenLoaded('categories'))
        ];
    }

    public function with(Request $request): array
    {
        return [
            'response' => [
                'status'=>200,
                'message'=>'success'
            ]
        ];
    }

}
