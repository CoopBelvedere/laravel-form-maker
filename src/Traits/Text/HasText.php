<?php

namespace Belvedere\FormMaker\Traits\Text;

trait HasText
{
    /**
     * Add a text value to the model.
     *
     * @param string $text
     * @return self
     */
    public function withText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}