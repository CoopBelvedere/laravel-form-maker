<?php

namespace Belvedere\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class RemoveFromRanking
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
     * Remove the deleted input from the rankings.
     *
     * @return void
     */
    protected function handle(): void
    {
        $ranker = $this->model->parent;

        if ($ranker) {
            $ranker->ranking->remove($this->model);
        }
    }
}
