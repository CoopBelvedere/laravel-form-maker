<?php

namespace Chess\FormMaker\Traits\Properties;

trait FormHtmlAttributes
{
    /**
     * Specifies the charset used in the submitted form.
     * default: the page charset
     *
     * @param string $charset
     * @return self
     */
    public function htmlCharset(?string $charset): self
    {
        $this->html_attributes = ['charset' => $charset];

        return $this;
    }

    /**
     * Specifies the encoding of the submitted data.
     * default: is url-encoded
     *
     * @param string $enctype
     * @return self
     */
    public function htmlEnctype(?string $enctype): self
    {
        $this->html_attributes = ['enctype' => $enctype];

        return $this;
    }
    
    /**
     * Specifies that the browser should not validate the form.
     *
     * @param string $novalidate
     * @return self
     */
    public function htmlNovalidate(?string $novalidate = 'novalidate'): self
    {
        $this->html_attributes = ['novalidate' => $novalidate];

        return $this;
    }

    /**
     * Specifies the target of the address in the action attribute.
     * This will make the form result open in a new browser tab.
     *
     * @param string $blank
     * @return self
     */
    public function htmlResultsInNewWindow(?string $blank = '_blank'): self
    {
        $this->html_attributes = ['target' => $blank];

        return $this;
    }
}