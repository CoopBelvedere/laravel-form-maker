<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasChecked
{
    /**
     * Pre-checks the control before the user interacts with it.
     *
     * @param string $checked
     * @return self
     */
    public function propertyChecked(?string $checked = 'checked'): self
    {
        $this->html_properties = ['checked' => $checked];

        return $this;
    }
}
