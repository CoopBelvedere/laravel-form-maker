<?php

namespace Belvedere\FormMaker\Listeners;

use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;
use Belvedere\FormMaker\Models\Model;

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
     * @return void
     */
    protected function deleteNodes(): void
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $nodeRepository->delete($this->model);
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