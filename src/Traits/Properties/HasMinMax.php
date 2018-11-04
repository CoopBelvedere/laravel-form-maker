<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasMinMax
{
    /**
     * Specifies the maximum value for an input field.
     *
     * @param mixed $max
     * @return self
     */
    public function propertyMax($max = null): self
    {
        $this->html_properties = ['max' => $max];

        return $this;
    }

    /**
     * Specifies the minimum value for an input field.
     *
     * @param mixed $min
     * @return self
     */
    public function propertyMin($min = null): self
    {
        $this->html_properties = ['min' => $min];

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
        $this->html_properties = ['step' => $step];

        return $this;
    }
}
