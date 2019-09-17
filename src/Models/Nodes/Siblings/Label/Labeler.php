<?php


namespace Belvedere\FormMaker\Models\Nodes\Siblings\Label;

use Belvedere\FormMaker\{
    Contracts\Resources\LabelResourcerContract,
    Contracts\Siblings\Label\LabelerContract,
    Contracts\Text\HasTextContract,
    Models\Nodes\Siblings\Sibling,
    Scopes\NodeScope,
    Traits\Text\HasText
};
use Illuminate\Http\Resources\Json\JsonResource;

class Labeler extends Sibling implements HasTextContract, LabelerContract
{
    use HasText;

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

        $this->setHtmlAttributesAttribute([
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