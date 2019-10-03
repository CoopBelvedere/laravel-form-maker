<?php

namespace Belvedere\FormMaker\Traits\Text;

use Belvedere\FormMaker\Contracts\Traits\Text\HasTextContract;

trait HasText
{
    /**
     * Add a text value to the model.
     *
     * @param string $text
     * @return \Belvedere\FormMaker\Contracts\Traits\Text\HasTextContract
     */
    public function withText(string $text): HasTextContract
    {
        $this->text = $text;

        return $this;
    }
}
