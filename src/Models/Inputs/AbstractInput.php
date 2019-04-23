<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Http\Resources\InputResource;
use Belvedere\FormMaker\Listeners\{
    AssignAttributes,
    RemoveFromRanking,
    ValidateProperties
};
use Belvedere\FormMaker\Models\Form\AbstractModel;
use Belvedere\FormMaker\Traits\{
    HasRules,
    Attributes\HasInputAttributes
};
use Illuminate\Database\Eloquent\Relations\MorphTo;

abstract class AbstractInput extends AbstractModel
{
    use HasInputAttributes, HasRules;

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
     * Mass removal of validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function removeRules(array $rules): self
    {
        foreach ($rules as $rule) {
            $this->assignToInput('rule', $rule, null);
        }
        return $this;
    }

    /**
     * Set the model rules.
     *
     * @param  array $rules
     * @return void
     */
    public function setRulesAttribute(array $rules): void
    {
        if (isset($this->attributes['rules'])) {
            $rules = $this->removeNullValues(
                array_merge($this->rules, $rules)
            );
        }
        $this->attributes['rules'] = json_encode($rules);
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Belvedere\FormMaker\Http\Resources\InputResource
     */
    public function toApi(): InputResource
    {
        return new InputResource($this);
    }

    /**
     * Mass assign validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function withRules(array $rules): self
    {
        foreach ($rules as $name => $arguments) {
            $this->assignToInput('rule', $name, $arguments);
        }
        return $this;
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
    public function inputable(): MorphTo
    {
        return $this->morphTo();
    }
}
