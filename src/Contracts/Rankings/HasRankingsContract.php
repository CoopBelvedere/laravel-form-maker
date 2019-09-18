<?php

namespace Belvedere\FormMaker\Contracts\Rankings;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface HasRankingsContract
{
    /**
     * Get the model rankings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ranking(): MorphOne;

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void;
}