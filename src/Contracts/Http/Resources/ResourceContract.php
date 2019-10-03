<?php

namespace Belvedere\FormMaker\Contracts\Http\Resources;

interface ResourceContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array;
}