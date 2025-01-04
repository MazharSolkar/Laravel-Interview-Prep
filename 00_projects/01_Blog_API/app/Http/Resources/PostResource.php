<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'tile'=>$this->title,
            'image'=>$this->image ?? null,
            'categoreis'=>$this->categories->pluck('name') ?? null,
            'owner_id'=> $this->user_id ?? null,
            'owner_name'=>$this->user->name?? null,
            $this->mergeWhen($request->route()->uri == 'api/post/{post}',[
                'content'=>$this->content,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
            ]),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'response' => [
                'status' => 200,
                'message' => 'single post',
                ]
        ];
    }

}
