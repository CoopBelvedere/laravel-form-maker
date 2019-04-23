<?php

namespace Belvedere\FormMaker\Contracts\Ranking;

interface HasRankingContract
{
    /**
     * Get the model ranking.
     *
     * @return mixed
     */
    public function ranking();
}