<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Listeners\{
    AddInRanking,
    AssignProperties,
    RemoveFromRanking,
    ValidateProperties
};
use Chess\FormMaker\Models\Form\Model;
use Chess\FormMaker\Traits\{
    InputRules,
    Properties\InputProperties
};
use Illuminate\Database\Eloquent\Relations\MorphTo;

abstract class Input extends Model
{
    use InputProperties, InputRules;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inputs';

    /**
     * The default properties automatically assigned on creation.
     *
     * @var array
     */
    public $assignedProperties = [
        'id',
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_properties' => 'array',
        'rules' => 'array',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => AddInRanking::class,
        'creating' => AssignProperties::class,
        'deleted' => RemoveFromRanking::class,
        'saving' => ValidateProperties::class,
    ];

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
