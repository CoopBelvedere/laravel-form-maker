<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait InputProperties
{
    /**
     * Specifies that the input field is disabled.
     *
     * @param string $disabled
     * @return self
     */
    public function htmlDisabled(?string $disabled = 'disabled'): self
    {
        $this->html_attributes = ['disabled' => $disabled];

        return $this;
    }

    /**
     * Add a description to help the user.
     *
     * @param string $title
     * @return self
     */
    public function htmlTitle(?string $title): self
    {
        $this->html_attributes = ['title' => $title];

        return $this;
    }

    /**
     * Specifies the value property for an input field.
     *
     * @param string $value
     * @return self
     */
    public function htmlValue(?string $value): self
    {
        $this->html_attributes = ['value' => $value];

        return $this;
    }
}
