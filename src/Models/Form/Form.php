<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\{
    Contracts\Form\FormContract,
    Contracts\Nodes\HasNodesContract,
    Http\Resources\Form\FormResource,
    Listeners\CascadeDelete,
    Models\Model,
    Traits\Nodes\HasNodes,
    Traits\Rankings\HasRankings
};

class Form extends Model implements FormContract, HasNodesContract
{
    use HasNodes, HasRankings;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleting' => CascadeDelete::class,
    ];

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
     * Disable all inputs.
     *
     * @return void
     */
    public function disabled(): void
    {
        $this->setInputsUsability('disabled');
    }

    /**
     * Enable all inputs.
     *
     * @return void
     */
    public function enabled(): void
    {
        $this->setInputsUsability();
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
        return $this->nodes('inputs')->mapWithKeys(function ($input) {
            if ($input->rules) {
                return [$input->html_attributes['name'] => implode('|', $input->rules)];
            }
            return [];
        })->all();
    }

    /**
     * Set whether the inputs are disabled or not.
     *
     * @param string|null $disabled
     */
    protected function setInputsUsability(?string $disabled = null): void
    {
        foreach ($this->nodes('inputs') as $input) {
            $input->withHtmlAttributes(['disabled' => $disabled])->save();
        }
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
