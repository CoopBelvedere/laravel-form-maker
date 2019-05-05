<?php

namespace Belvedere\FormMaker\Traits\Rules;

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
            if (method_exists($this, $method)) {
                $this->$method(null);
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
     * Mass assign validation rules to an input.
     *
     * @param array $rules
     * @return self
     */
    public function withRules(array $rules): self
    {
        foreach ($rules as $method => $arguments) {
            if (method_exists($this, $method)) {
                if ($method === $arguments) {
                    $this->$method();
                } else {
                    $this->$method(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }
}