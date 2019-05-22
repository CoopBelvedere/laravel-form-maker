<?php

namespace Belvedere\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class DeleteChildren
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
        if (method_exists($this->model, 'inputs')) {
            $children = $this->model->inputs();
        } else if (method_exists($this->model, 'options')) {
            $children = $this->model->options()->get();
        }

        foreach ($children as $child) {
            $child->delete();
        }
    }
}
