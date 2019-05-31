<?php

namespace Belvedere\FormMaker\Contracts\Siblings;

use Belvedere\FormMaker\Contracts\ModelContract;

interface SiblingContract extends ModelContract
{
    /**
     * Get the model who owns this sibling.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent();

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}