<?php

namespace Belvedere\FormMaker\Traits\Nodes;

trait HasNodes
{
    public function __call(string $name , array $arguments = [])
    {
        dd('call');
    }
}