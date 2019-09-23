<?php


namespace Belvedere\FormMaker\Listeners;

use Belvedere\FormMaker\Models\Model;
use Illuminate\Support\Collection;

class CascadeDelete
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
        $this->deleteNodes();

        $this->deleteRanking();
    }

    /**
     * Delete all the model nodes.
     *
     * @param array $nodes
     * @return void
     */
    protected function deleteNodes(): void
    {
        $nodes = $this->getNodes();

        foreach ($nodes as $node) {
            $node->delete();
        }
    }

    /**
     * Get all the model nodes.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getNodes(): Collection
    {
        $nodes = collect([]);

        if (method_exists($this->model, 'inputs')) {
            $nodes = $this->model->inputs();
        } else if (method_exists($this->model, 'options')) {
            $nodes = $this->model->options()->get();
        }

        if (method_exists($this->model, 'siblings')) {
            $nodes = $nodes->merge($this->model->siblings());
        }

        return $nodes;
    }

    /**
     * Delete the model rankings.
     *
     * @return void
     */
    protected function deleteRanking(): void
    {
        if ($this->model->ranking) {
            $this->model->ranking->delete();
        }
    }
}