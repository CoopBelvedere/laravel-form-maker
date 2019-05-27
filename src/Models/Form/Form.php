<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\Contracts\Form\FormContract;
use Belvedere\FormMaker\Contracts\Inputs\HasInputsContract;
use Belvedere\FormMaker\Http\Resources\Form\FormResource;
use Belvedere\FormMaker\Listeners\ValidateProperties;
use Belvedere\FormMaker\Traits\HasRanking;
use Belvedere\FormMaker\Traits\Nodes\HasHtmlElements;
use Belvedere\FormMaker\Traits\Nodes\HasInputs;

class Form extends Model implements FormContract, HasInputsContract
{
    use HasInputs, HasRanking, HasHtmlElements;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => ValidateProperties::class,
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

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'charset',
            'name',
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
