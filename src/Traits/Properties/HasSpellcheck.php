<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasSpellcheck
{
    /**
     * Specifies whether the input field is to have its spelling and grammar
     * checked or not.
     *
     * @param bool $spellcheck
     * @return self
     */
    public function propertySpellcheck(?bool $spellcheck = true): self
    {
        $this->html_properties = ['spellcheck' => $spellcheck];

        return $this;
    }
}
