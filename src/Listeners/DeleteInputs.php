<?php

namespace Belvedere\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class DeleteInputs
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
     * Delete the model's inputs.
     *
     * @return void
     */
    protected function handle(): void
    {
        $inputs = $this->model->inputs();

        foreach ($inputs as $input) {
            $input->delete();
        }
    }
}
