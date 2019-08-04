<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\{
    Contracts\Inputs\InputContract,
    Contracts\Nodes\HasSiblingsContract,
    Contracts\Resources\InputResourcerContract,
    Contracts\Rules\HasRulesContract,
    Listeners\AssignAttributes,
    Models\Siblings\Sibling,
    Models\ModelWithNodes,
    Traits\Nodes\HasSiblings,
    Traits\Rankings\InRanking,
    Traits\Rules\HasRules,
};
use Illuminate\{
    Database\Eloquent\Relations\MorphTo,
    Http\Resources\Json\JsonResource
};

class Input extends ModelWithNodes implements HasSiblingsContract, HasRulesContract, InputContract
{
    use HasSiblings, HasRules, InRanking;

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
     * AbstractInput constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.inputs_table', 'inputs');

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
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

        $this->dispatchesEvents = array_merge($this->dispatchesEvents, [
            'creating' => AssignAttributes::class,
        ]);

        $this->setHtmlAttributesProvider();

        $this->setRankingProvider();

        $this->setRulesProvider();
    }

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return \Belvedere\FormMaker\Models\Siblings\Sibling|null
     * @throws \Exception
     */
    protected function getNode(string $nodeKey): ?Sibling
    {
        return $this->siblings()->firstWhere('type', $nodeKey);
    }

    /**
     * Get the model nodes query builder.
     *
     * @param mixed $node
     * @return mixed
     */
    protected function nodesQueryBuilder($node)
    {
        return $this->morphMany($this->resolve($node), 'siblingable');
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
     * Get the model who owns this input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent(): MorphTo
    {
        return $this->morphTo('inputable');
    }
}
