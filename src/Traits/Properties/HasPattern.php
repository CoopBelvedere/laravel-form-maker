<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasPattern
{
    /**
     * Specifies a regular expression that the input field value is checked against.
     *
     * @param string $pattern
     * @return self
     */
    public function htmlPattern(?string $pattern): self
    {
        $this->html_attributes = ['pattern' => $pattern];

        return $this;
    }
}
