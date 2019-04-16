<?php

namespace Chess\FormMaker\Traits\Properties;

trait GlobalProperties
{
    /**
     * Specifies a class attribute for the html element.
     *
     * @param string $class
     * @return self
     */
    public function propertyClass(?string $class): self
    {
        $this->html_properties = ['class' => $class];

        return $this;
    }

    /**
     * Specifies a data attribute for the html element.
     *
     * @param string $data
     * @param mixed $value
     * @return self
     */
    public function propertyData(string $data, $value = null): self
    {
        $this->html_properties = [$data => $value];

        return $this;
    }

    /**
     * Specifies an id attribute for the html element.
     *
     * @param mixed $id
     * @return self
     */
    public function propertyId($id = null): self
    {
        $this->html_properties = ['id' => $id];

        return $this;
    }

    /**
     * Specifies a name used to identify the form or the input.
     *
     * @param string $name
     * @return self
     */
    public function propertyName(?string $name): self
    {
        $this->html_properties = ['name' => $name];

        return $this;
    }

    /**
     * Specifies a role attribute for the html element.
     *
     * @param string $role
     * @return self
     */
    public function propertyRole(?string $role): self
    {
        $this->html_properties = ['role' => $role];

        return $this;
    }
}
