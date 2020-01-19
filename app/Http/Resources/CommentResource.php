<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommentResource.
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request Request.
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'context' => $this->resource->context,
        ];
    }
}
