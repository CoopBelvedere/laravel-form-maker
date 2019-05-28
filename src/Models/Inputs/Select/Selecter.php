<?php

namespace Belvedere\FormMaker\Models\Inputs\Select;

use Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract;
use Belvedere\FormMaker\Contracts\Nodes\HasOptionsContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\Nodes\HasOptions;

class Selecter extends Input implements HasOptionsContract, SelecterContract
{
    use HasOptions;

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
    }

    /**
     * Get the model nodes query builder.
     *
     * @param mixed $node
     * @return mixed
     */
    protected function nodesQueryBuilder($node)
    {
        if ($node === 'option') {
            return $this->morphMany($this->resolve($node), 'inputable');
        }

        return parent::nodesQueryBuilder($node);
    }
}
