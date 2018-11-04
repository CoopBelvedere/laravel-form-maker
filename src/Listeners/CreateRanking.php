<?php

namespace Chess\FormMaker\Listeners;

use Chess\FormMaker\Models\Ranking;
use Illuminate\Database\Eloquent\Model;

class CreateRanking
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
     * Associate a rankings with the model.
     *
     * @return void
     */
    protected function handle(): void
    {
        $ranking = new Ranking();

        $ranking->ranks = [];

        $this->model->ranking()->save($ranking);
    }
}
