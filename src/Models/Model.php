<?php

namespace Belvedere\FormMaker\Models;

use Belvedere\FormMaker\{
    Contracts\HtmlAttributes\HasHtmlAttributesContract,
    Traits\HtmlAttributes\HasHtmlAttributes
};
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent implements HasHtmlAttributesContract
{
    use HasHtmlAttributes;

    /**
     * The default html attributes automatically assigned on creation.
     *
     * @var array
     */
    protected $htmlAttributesAssigned = [];

    /**
     * The list of html attributes available for the model.
     *
     * @var array
     */
    protected $htmlAttributesAvailable = [
        'class',
        'data',
        'id',
        'role',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_attributes' => 'array',
    ];

    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @return array
     */
    public function getHtmlAttributesAssigned(): array
    {
        return $this->htmlAttributesAssigned;
    }
}
