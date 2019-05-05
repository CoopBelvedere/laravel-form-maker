<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Contracts\Rules\HasRulesContract;
use Belvedere\FormMaker\Http\Resources\InputResource;
use Belvedere\FormMaker\Listeners\{
    AssignAttributes,
    RemoveFromRanking,
    ValidateProperties
};
use Belvedere\FormMaker\Models\Form\AbstractNode;
use Belvedere\FormMaker\Traits\Rules\HasRules;
use Illuminate\Database\Eloquent\Relations\MorphTo;

abstract class AbstractInput extends AbstractNode implements HasRulesContract
{
    use HasRules;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inputs';

    /**
     * The default attributes automatically assigned on creation.
     *
     * @var array
     */
    public $assignedAttributes = [
        'id',
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_attributes' => 'array',
        'rules' => 'array',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => AssignAttributes::class,
        'deleted' => RemoveFromRanking::class,
        'updating' => ValidateProperties::class,
    ];

    /**
     * Transform the input to JSON.
     *
     * @return \Belvedere\FormMaker\Http\Resources\InputResource
     */
    public function toApi(): InputResource
    {
        return new InputResource($this);
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the form who owns this input.
     * Alias of inputable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function form(): MorphTo
    {
        return $this->inputable();
    }

    /**
     * Get the model who owns this input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    protected function inputable(): MorphTo
    {
        return $this->morphTo();
    }
}
