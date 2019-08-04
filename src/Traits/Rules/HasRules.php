<?php

namespace Belvedere\FormMaker\Traits\Rules;

use Belvedere\FormMaker\Contracts\Rules\RulerContract;

trait HasRules
{
    /**
     * The current implementation of the RulerContract.
     *
     * @var mixed
     */
    protected $rulesProvider;

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

    /**
     * Mass removal of validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function removeRules(array $rules): self
    {
        $this->setRules(array_fill_keys($rules, null));

        return $this;
    }

    /**
     * Append the rules in the existing list of validations.
     *
     * @param array $rules
     * @return void
     */
    protected function setRules(array $rules): void
    {
        foreach ($rules as $rule => $value) {
            $this->rulesProvider->$rule = $value;
        }

        $this->rules = $this->rulesProvider->getRules();

        $this->rulesProvider->clearRules();
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
        $this->setRules($rules);

        return $this;
    }
}
