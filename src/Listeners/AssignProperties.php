<?php

namespace Chess\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class AssignProperties
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
     * Handle the event.
     *
     * @return void
     */
    protected function handle(): void
    {
        $this->model->type = $this->model->getClassName();

        foreach ($this->model->assignedProperties as $property) {
            if (!isset($this->model->html_attributes[$property])) {
                $this->setProperty($property);
            }
        }
    }

    /**
     * Set the assigned property.
     *
     * @param string $property
     * @return void
     */
    protected function setProperty(string $property): void
    {
        $this->model->html_attributes = [$property => uniqid(sprintf('%s_', $this->model->type))];
    }
}
