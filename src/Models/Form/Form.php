<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\{
    Contracts\Form\FormContract,
    Contracts\Nodes\HasInputsContract,
    Http\Resources\Form\FormResource,
    Listeners\ValidateProperties,
    Models\Inputs\Input,
    Models\ModelWithNodes,
    Traits\Nodes\HasInputs
};
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Form extends ModelWithNodes implements HasInputsContract, FormContract
{
    use HasInputs;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'name',
    ];

    /**
     * Form constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.forms_table', 'forms');

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'charset',
            'enctype',
            'name',
            'novalidate',
            'target',
        ]);

        $this->dispatchesEvents = array_merge($this->dispatchesEvents, [
            'saving' => ValidateProperties::class,
        ]);

        $this->setHtmlAttributesProvider();

        $this->setRankingProvider();
    }

    /**
     * Specifies the form url action.
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): FormContract
    {
        $this->html_attributes = ['action' => $action];

        return $this;
    }

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return \Belvedere\FormMaker\Models\Inputs\Input|null
     * @throws \Exception
     */
    protected function getNode(string $nodeKey): ?Input
    {
        return $this->inputs()->firstWhere('html_attributes.name', $nodeKey);
    }

    /**
     * Specifies the form http method.
     *
     * @param string $method
     * @return self
     */
    public function method(string $method): FormContract
    {
        $this->html_attributes = ['method' => $method];

        return $this;
    }

    /**
     * Get the form nodes query builder.
     *
     * @param string $node
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * @throws \Exception
     */
    protected function nodesQueryBuilder($node): MorphMany
    {
        return $this->morphMany($this->resolve($node), 'inputable');
    }

    /**
     * Return the form inputs rules in a form request format.
     *
     * @return array
     * @throws \Exception
     */
    public function rules(): array
    {
        return $this->inputs()->mapWithKeys(function ($input) {
            if ($input->rules) {
                return [$input->html_attributes['name'] => implode('|', $input->rules)];
            }
            return [];
        })->all();
    }

    /**
     * Transform the form to JSON.
     *
     * @return \Belvedere\FormMaker\Http\Resources\Form\FormResource
     */
    public function toApi(): FormResource
    {
        return new FormResource($this);
    }
}
