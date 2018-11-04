<?php

namespace Chess\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class AddInRanking
{
    /**
     * The model with assigned properties.
     *
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->handle();
    }

    /**
     * Add the new input in the rankings.
     *
     * @return void
     */
    protected function handle(): void
    {
        $this->model->inputable->ranking->add($this->model->id);
    }
}
