<?php

namespace Belvedere\FormMaker\Contracts\Resources;

interface ElementResourcerContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array;
}