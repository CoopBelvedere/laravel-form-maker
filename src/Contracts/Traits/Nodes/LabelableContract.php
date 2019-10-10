<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

interface LabelableContract
{
    /**
     * Get the labelable attribute name.
     * for or form.
     *
     * @return string
     */
    public function getLabelableAttributeName(): string;
}
