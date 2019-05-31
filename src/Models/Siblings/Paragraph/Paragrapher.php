<?php

namespace Belvedere\FormMaker\Models\Siblings\Paragraph;

use Belvedere\FormMaker\Contracts\Siblings\Paragraph\ParagrapherContract;
use Belvedere\FormMaker\Contracts\Text\HasTextContract;
use Belvedere\FormMaker\Models\Siblings\Sibling;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\Text\HasText;

class Paragrapher extends Sibling implements HasTextContract, ParagrapherContract
{
    use HasText;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('paragraph'));
    }
}