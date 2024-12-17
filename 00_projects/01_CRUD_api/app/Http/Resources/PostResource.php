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
            'title'=> $this->title,
            'uri'=> $request->route()->uri,
            $this->mergeWhen($request->route()->uri == "api/v1/post/{post}",[
                'content'=> $this->content,
                'user_id'=>$this->user_id,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at
            ]),
        ];
    }
    public function with(Request $request): array
    {
        return [
            'response'=> [
                'message' => 'single Post'
            ]
        ];
    }
}
