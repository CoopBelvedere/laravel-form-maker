<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings\Paragraph;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Models\Nodes\Siblings\Sibling;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Paragraph\ParagrapherContract;

class Paragrapher extends Sibling implements ParagrapherContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('paragraph'));
    }
}
