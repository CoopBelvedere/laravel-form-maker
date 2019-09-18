<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs;

use Belvedere\FormMaker\{
    Contracts\Inputs\InputContract,
    Contracts\Resources\InputResourcerContract,
    Contracts\Nodes\HasNodesContract,
    Listeners\AssignAttributes,
    Listeners\RemoveFromRanking,
    Models\Nodes\Node,
    Traits\Nodes\HasNodes,
    Traits\Rankings\HasRankings,
    Traits\Rules\HasRules
};
use Illuminate\Http\Resources\Json\JsonResource;

class Input extends Node implements HasNodesContract, InputContract
{
    use HasNodes, HasRankings, HasRules;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => AssignAttributes::class,
        'deleted' => RemoveFromRanking::class,
    ];

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
