<?php

namespace Belvedere\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class DeleteNodes
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
     * Delete the model's children.
     *
     * @return void
     */
    protected function handle(): void
    {
        foreach ([] as $node) {
            $node->delete();
        }
    }
}
