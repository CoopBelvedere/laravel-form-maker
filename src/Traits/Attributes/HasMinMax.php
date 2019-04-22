<?php

namespace Belvedere\FormMaker\Traits\Attributes;

trait HasMinMax
{
    /**
     * Specifies the maximum value for an input field.
     *
     * @param mixed $max
     * @return self
     */
    public function htmlMax($max = null): self
    {
        $this->html_attributes = ['max' => $max];

        return $this;
    }

    /**
     * Specifies the minimum value for an input field.
     *
     * @param mixed $min
     * @return self
     */
    public function htmlMin($min = null): self
    {
        $this->html_attributes = ['min' => $min];

        return $this;
    }

    /**
     * Specifies the legal number intervals for an input field.
     * The control accepts only values at multiples of the step value
     * greater than the minimum
     *
     * @param $step
     * @return self
     */
    public function htmlStep($step = null): self
    {
        $this->html_attributes = ['step' => $step];

        return $this;
    }
}
