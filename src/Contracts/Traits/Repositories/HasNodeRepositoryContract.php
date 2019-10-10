<?php

namespace Belvedere\FormMaker\Contracts\Traits\Repositories;

interface HasNodeRepositoryContract
{
    /**
     * Set the node repository provider used by the model.
     *
     * @return void
     */
    public function setNodeRepositoryProvider(): void;
}
