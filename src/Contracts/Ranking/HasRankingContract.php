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

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void;
}