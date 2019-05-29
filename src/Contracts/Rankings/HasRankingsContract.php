<?php

namespace Belvedere\FormMaker\Contracts\Rankings;

interface HasRankingsContract
{
    /**
     * Get the model rankings.
     *
     * @return mixed
     */
    public function rankings();

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void;
}