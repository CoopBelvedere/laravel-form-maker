<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\{
    Contracts\Form\FormContract,
    Contracts\Nodes\HasNodesContract,
    Http\Resources\Form\FormResource,
    Models\Model,
    Traits\Nodes\HasNodes,
    Traits\Rankings\HasRankings
};

class Form extends Model implements HasNodesContract, FormContract
{
    use HasNodes, HasRankings;

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

        $this->addAvailableAttributes([
            'accept-charset',
            'enctype',
            'name',
            'novalidate',
            'target',
        ]);

        $this->setRankingProvider();
    }

    /**
     * Specifies the form url action.
     *
     * @param string|null $action
     * @return self
     */
    public function action(?string $action): FormContract
    {
        $this->html_attributes = ['action' => $action];

        return $this;
    }

    /**
     * Specifies the form http method.
     *
     * @param string|null $method
     * @return self
     */
    public function method(?string $method): FormContract
    {
        $this->html_attributes = ['method' => $method];

        return $this;
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
