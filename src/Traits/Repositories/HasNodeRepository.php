<?php

namespace Belvedere\FormMaker\Traits\Repositories;

use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;

trait HasNodeRepository
{
    /**
     * The current implementation of the NodeRepositoryContract.
     *
     * @var mixed
     */
    protected $nodeRepositoryProvider;

    /**
     * Set the node repository provider used by the model.
     *
     * @return void
     */
    public function setNodeRepositoryProvider(): void
    {
        $this->nodeRepositoryProvider = resolve(NodeRepositoryContract::class);
    }
}