<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\Ranking\HasRankingContract;

interface HasOptionsContract extends HasRankingContract
{
    /**
     * Get the options that belongs to the input.
     *
     * @return mixed
     */
    public function options();

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return self
     * @throws \Exception
     */
    public function withOptions(array ...$options);
}