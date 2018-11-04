<?php

namespace Chess\FormMaker\Traits\Properties;

trait FormProperties
{
    /**
     * Specifies the charset used in the submitted form.
     * default: the page charset
     *
     * @param string $charset
     * @return self
     */
    public function propertyCharset(?string $charset): self
    {
        $this->html_properties = ['charset' => $charset];

        return $this;
    }

    /**
     * Specifies the encoding of the submitted data.
     * default: is url-encoded
     *
     * @param string $enctype
     * @return self
     */
    public function propertyEnctype(?string $enctype): self
    {
        $this->html_properties = ['enctype' => $enctype];

        return $this;
    }
    
    /**
     * Specifies that the browser should not validate the form.
     *
     * @param string $novalidate
     * @return self
     */
    public function propertyNovalidate(?string $novalidate = 'novalidate'): self
    {
        $this->html_properties = ['novalidate' => $novalidate];

        return $this;
    }

    /**
     * Specifies the target of the address in the action attribute.
     * This will make the form result open in a new browser tab.
     *
     * @param string $blank
     * @return self
     */
    public function propertyResultsInNewWindow(?string $blank = '_blank'): self
    {
        $this->html_properties = ['target' => $blank];

        return $this;
    }
}
