<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->toArray();
    }
    public function with($request)
    {
        return [
            'meta'=>[
                'queries'=> $request->getQueryString()
            ]
        ];
    }
}
