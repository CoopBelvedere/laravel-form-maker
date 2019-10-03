<?php

namespace Belvedere\FormMaker\Contracts\Traits\Text;

interface HasTextContract
{
    /**
     * Add a text value to the model.
     *
     * @param string $text
     * @return \Belvedere\FormMaker\Contracts\Traits\Text\HasTextContract
     */
    public function withText(string $text): self;
}
