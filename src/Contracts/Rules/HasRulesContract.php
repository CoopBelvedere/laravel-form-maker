<?php

namespace Belvedere\FormMaker\Contracts\Rules;

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
     * Mass assign validation rules from an input.
     *
     * @param array $rules
     * @return self
     */
    public function withRules(array $rules);
}