<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings\Label;

use Belvedere\FormMaker\Scopes\NodeScope;
use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Models\Nodes\Siblings\Sibling;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\LabelResourcerContract;

class Labeler extends Sibling implements LabelerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('label'));
    }

    /**
     * Labeler constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'for',
            'form',
        ]);
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(LabelResourcerContract::class, ['label' => $this]);
    }
}
