<?php

namespace Belvedere\FormMaker\Models\Inputs\Select;

use Belvedere\FormMaker\Contracts\Inputs\HasOptionsContract;
use Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInputs;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\HasRanking;
use Belvedere\FormMaker\Traits\Inputs\HasOptions;

class Selecter extends AbstractInputs implements HasOptionsContract, SelecterContract
{
    use HasOptions, HasRanking;

    /**
     * The current implementation of the RankingContract
     *
     * @var mixed
     */
    protected $rankingProvider;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new ModelScope('select'));

        parent::boot();
    }

    /**
     * Selecter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'multiple',
            'readonly',
            'required',
            'size'
        ]);

        $this->setRankingProvider();
    }
}
