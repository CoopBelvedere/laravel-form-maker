<?php

namespace Belvedere\FormMaker\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class NodeScope implements Scope
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
     * @var string
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
