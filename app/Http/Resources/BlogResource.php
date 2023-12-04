<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $options = [
            'join' => ', ',
            'parts' => 2,
            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
          ];
        $now = Carbon::now();
        $date = $now->diffForHumans($this->created_at, $options);
        $media = $this->getMedia('images')->first();
        $path = '';
        if($media){
            $path = 'storage/' .$media->id . '/' . $media->file_name;
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description'  => $this->description,
            'user' => new UserResource($this->user),
            'comments' => $this->comments ? CommentResource::collection($this->comments) : [],
            'comments_count' => $this->comments()->count(),
            'image' => $path ? asset($path) : '',
            'created_at' => $this->created_at->toDateTimeString(),
            'date' => $date

        ];
    }
}