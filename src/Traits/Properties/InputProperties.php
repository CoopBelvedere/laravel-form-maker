<?php

namespace Chess\FormMaker\Traits\Properties;

trait InputProperties
{
    /**
     * Specifies that the input field is disabled.
     *
     * @param string $disabled
     * @return self
     */
    public function propertyDisabled(?string $disabled = 'disabled'): self
    {
        $this->html_properties = ['disabled' => $disabled];

        return $this;
    }

    /**
     * Add a description to help the user.
     *
     * @param string $title
     * @return self
     */
    public function propertyTitle(?string $title): self
    {
        $this->html_properties = ['title' => $title];

        return $this;
    }

    /**
     * Specifies the value property for an input field.
     *
     * @param string $value
     * @return self
     */
    public function propertyValue(?string $value): self
    {
        $this->html_properties = ['value' => $value];

        return $this;
    }
}
