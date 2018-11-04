<?php

namespace Chess\FormMaker\Scopes;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Scope
};

class InputScope implements Scope
{
    /**
     * The input type that get scoped.
     *
     * @var string
     */
    protected $type;

    /**
     * The scope constructor.
     *
     * @var string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('type', '=', $this->type);
    }
}
