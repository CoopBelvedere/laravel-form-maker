<?php

namespace Belvedere\FormMaker\Listeners;

use Illuminate\Database\Eloquent\Model;

class AssignAttributes
{
    /**
     * The model with assigned attributes.
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

        foreach ($this->model->assignedAttributes as $attribute) {
            if (!isset($this->model->html_attributes[$attribute])) {
                $this->setAttribute($attribute);
            }
        }
    }

    /**
     * Set the assigned attribute.
     *
     * @param string $attribute
     * @return void
     */
    protected function setAttribute(string $attribute): void
    {
        $this->model->html_attributes = [$attribute => uniqid(sprintf('%s_', $this->model->type))];
    }
}
