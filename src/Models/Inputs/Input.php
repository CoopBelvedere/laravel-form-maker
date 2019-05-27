<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Contracts\Inputs\InputContract;
use Belvedere\FormMaker\Contracts\Resources\InputResourcerContract;
use Belvedere\FormMaker\Contracts\Rules\HasRulesContract;
use Belvedere\FormMaker\Listeners\{
    AssignAttributes,
    ValidateProperties
};
use Belvedere\FormMaker\Models\Form\Model;
use Belvedere\FormMaker\Traits\Ranking\InRanking;
use Belvedere\FormMaker\Traits\Rules\HasRules;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Resources\Json\JsonResource;

class Input extends Model implements HasRulesContract, InputContract
{
    use HasRules, InRanking;

    /**
     * The default attributes automatically assigned on creation.
     *
     * @var array
     */
    protected $htmlAttributesAssigned = [
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
        'updating' => ValidateProperties::class,
    ];

    /**
     * AbstractInput constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.inputs_table', 'inputs');

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'disabled',
            'name',
            'title',
            'value',
        ]);

        $this->setHtmlAttributesProvider();

        $this->setRulesProvider();
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(InputResourcerContract::class, ['input' => $this]);
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
