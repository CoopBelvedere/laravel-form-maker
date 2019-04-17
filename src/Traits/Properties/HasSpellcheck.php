<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasSpellcheck
{
    /**
     * Specifies whether the input field is to have its spelling and grammar
     * checked or not.
     *
     * @param bool $spellcheck
     * @return self
     */
    public function htmlSpellcheck(?bool $spellcheck = true): self
    {
        $this->html_attributes = ['spellcheck' => $spellcheck];

        return $this;
    }
}
