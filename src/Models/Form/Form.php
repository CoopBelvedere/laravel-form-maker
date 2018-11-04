<?php

namespace Chess\FormMaker\Models\Form;

use Chess\FormMaker\Listeners\ValidateProperties;
use Chess\FormMaker\Traits\{
    HasInputs,
    Properties\FormProperties,
    Properties\HasAutocomplete
};

class Form extends Model
{
    use FormProperties, HasAutocomplete, HasInputs;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forms';

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
        'title',
    ];

    /**
     * Specifies the form url action.
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): self
    {
        $this->html_properties = ['action' => $action];

        return $this;
    }

    /**
     * Specifies the form http method.
     *
     * @param string $method
     * @return self
     */
    public function method(string $method): self
    {
        $this->html_properties = ['method' => $method];

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
            return [$input->html_properties['name'] => implode('|', $input->rules)];
        })->all();
    }
}
