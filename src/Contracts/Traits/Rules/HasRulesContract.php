<?php

namespace Belvedere\FormMaker\Contracts\Traits\Rules;

interface HasRulesContract
{
    /**
     * Mass removal of validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function removeRules(array $rules);

    /**
     * Set the model rules.
     *
     * @param  array $rules
     * @return void
     */
    public function setRulesAttribute(array $rules): void;

    /**
     * Set the rules provider used by the model.
     *
     * @return void
     */
    public function setRulesProvider(): void;

    /**
     * Mass assign validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function withRules(array $rules);
}
