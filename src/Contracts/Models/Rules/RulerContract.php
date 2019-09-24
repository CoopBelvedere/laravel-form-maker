<?php

namespace Belvedere\FormMaker\Contracts\Models\Rules;

interface RulerContract
{
    /**
     * Set the model rules.
     *
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set(string $name, $value): void;

    /**
     * Remove all the current rules.
     *
     * @return void
     */
    public function clearRules(): void;

    /**
     * Get all the current rules.
     *
     * @return array
     */
    public function getRules(): array;
}
