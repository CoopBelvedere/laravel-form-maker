<?php

namespace Belvedere\FormMaker\Traits\Rules;

use Belvedere\FormMaker\Contracts\Rules\RulerContract;
use Illuminate\Support\Arr;

trait HasRules
{
    /**
     * Mass removal of validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function removeRules(array $rules): self
    {
        foreach ($rules as $method => $arguments) {
            if (method_exists($this->rulesProvider, $method)) {
                $this->rules = $this->rulesProvider->$method(null);
            }
        }
        return $this;
    }

    /**
     * Set the model rules.
     *
     * @param  array $rules
     * @return void
     */
    public function setRulesAttribute(array $rules): void
    {
        if (isset($this->attributes['rules'])) {
            $rules = array_filter(array_merge($this->rules, $rules), function ($rule) {
                return !is_null($rule);
            });
        }
        $this->attributes['rules'] = json_encode($rules);
    }

    /**
     * Set the rules provider used by the model.
     *
     * @return void
     */
    public function setRulesProvider(): void
    {
        $this->rulesProvider = resolve(RulerContract::class);
    }

    /**
     * Mass assign validation rules to an input.
     *
     * @param array $rules
     * @return self
     */
    public function withRules(array $rules): self
    {
        foreach ($rules as $method => $arguments) {
            if (method_exists($this->rulesProvider, $method)) {
                if ($method === $arguments) {
                    $this->rules = $this->rulesProvider->$method();
                } else {
                    $this->rules = $this->rulesProvider->$method(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }
}