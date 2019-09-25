<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs;

use Belvedere\FormMaker\{
    Contracts\Http\Resources\Nodes\Inputs\InputResourcerContract,
    Contracts\Models\Nodes\Inputs\InputContract,
    Listeners\AssignAttributes,
    Listeners\CascadeDelete,
    Models\Nodes\Node,
    Traits\Nodes\HasLabel,
    Traits\Rankings\HasRankings,
    Traits\Rules\HasRules
};
use Illuminate\Http\Resources\Json\JsonResource;

class Input extends Node implements InputContract
{
    use HasLabel, HasRankings, HasRules;

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
     * Input constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dispatchesEvents = array_merge($this->dispatchesEvents, [
            'creating' => AssignAttributes::class,
            'deleting' => CascadeDelete::class,
        ]);

        $this->addAvailableAttributes([
            'autocomplete',
            'autofocus',
            'disabled',
            'form',
            'name',
            'readonly',
            'required',
            'title',
            'value',
        ]);

        $this->setRankingProvider();

        $this->setRulesProvider();
    }

    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @return array
     */
    public function getHtmlAttributesAssigned(): array
    {
        return $this->htmlAttributesAssigned;
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
}
