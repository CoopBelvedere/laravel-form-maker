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
     * The node model type.
     *
     * @var string $node
     */
    protected $nodeType;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $nodeType
     * @return void
     */
    public function __construct(Model $model, string $nodeType)
    {
        $this->model = $model;

        $this->nodeType = $nodeType;

        $this->handle();
    }

    /**
     * Delete the model's children.
     *
     * @return void
     */
    protected function handle(): void
    {
        if ($this->nodeType === 'inputs') {
            $nodes = $this->model->inputs();

        } else if ($this->nodeType === 'options') {
            $nodes = $this->model->options()->get();

        } else if ($this->nodeType === 'htmlElements') {
            $nodes = $this->model->htmlElements();
        }

        foreach ($nodes as $node) {
            $node->delete();
        }
    }
}
