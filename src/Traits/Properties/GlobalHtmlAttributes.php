<?php

namespace Chess\FormMaker\Traits\Properties;

trait GlobalHtmlAttributes
{
    /**
     * Specifies a class attribute for the html element.
     *
     * @param string $class
     * @return self
     */
    public function htmlClass(?string $class): self
    {
        $this->html_attributes = ['class' => $class];

        return $this;
    }

    /**
     * Specifies a data attribute for the html element.
     *
     * @param string $data
     * @param mixed $value
     * @return self
     */
    public function htmlData(string $data, $value = null): self
    {
        $this->html_attributes = [$data => $value];

        return $this;
    }

    /**
     * Specifies an id attribute for the html element.
     *
     * @param mixed $id
     * @return self
     */
    public function htmlId($id = null): self
    {
        $this->html_attributes = ['id' => $id];

        return $this;
    }

    /**
     * Specifies a name used to identify the form or the input.
     *
     * @param string $name
     * @return self
     */
    public function htmlName(?string $name): self
    {
        $this->html_attributes = ['name' => $name];

        return $this;
    }

    /**
     * Specifies a role attribute for the html element.
     *
     * @param string $role
     * @return self
     */
    public function htmlRole(?string $role): self
    {
        $this->html_attributes = ['role' => $role];

        return $this;
    }
}
