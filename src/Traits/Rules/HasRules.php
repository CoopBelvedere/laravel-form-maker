<?php

namespace Belvedere\FormMaker\Traits\Rules;

use Belvedere\FormMaker\Contracts\Rules\RulerContract;
use Illuminate\Support\Arr;

trait HasRules
{
    /**
     * The current implementation of the RulerContract.
     *
     * @var mixed
     */
    protected $rulesProvider;

    /**
     * Mass removal of validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function removeRules(array $rules): self
    {
        foreach ($rules as $rule => $arguments) {
            if ($this->isValidRule($rule)) {
                $this->rules = $this->rulesProvider->$rule(null);
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
        foreach ($rules as $rule => $arguments) {
            if ($this->isValidRule($rule)) {
                if (is_null($arguments)) {
                    $this->rules = $this->rulesProvider->$rule(null);
                } else if ($rule === $arguments) {
                    $this->rules = $this->rulesProvider->$rule();
                } else {
                    $this->rules = $this->rulesProvider->$rule(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }

    /**
     * Check if the rule exist.
     *
     * @param string $rule
     * @return bool
     */
    protected function isValidRule(string $rule): bool
    {
        return method_exists($this->rulesProvider, $rule);
    }
}