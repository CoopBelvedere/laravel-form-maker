<?php

namespace Belvedere\FormMaker\Models\Siblings\Paragraph;

use Belvedere\FormMaker\{
    Contracts\Siblings\Paragraph\ParagrapherContract,
    Contracts\Text\HasTextContract,
    Models\Siblings\Sibling,
    Scopes\ModelScope,
    Traits\Text\HasText
};

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