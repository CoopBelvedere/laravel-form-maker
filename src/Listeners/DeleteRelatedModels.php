<?php


namespace Belvedere\FormMaker\Listeners;

use Belvedere\FormMaker\Models\Model;

class DeleteRelatedModels
{
    /**
     * The model with assigned properties.
     *
     * @var \Belvedere\FormMaker\Models\Model $model
     */
    protected $model;

    /**
     * Create the event listener.
     *
     * @param \Belvedere\FormMaker\Models\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->handle();
    }

    /**
     * Delete an associated ranking with the model.
     *
     * @return void
     */
    protected function handle(): void
    {
        $this->model->ranking->delete();
    }
}