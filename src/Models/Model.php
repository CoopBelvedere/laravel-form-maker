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
        'className',
        'data',
        'id',
        'role',
    ];

    /**
     * Additional validation to be applied on the model attributes on update.
     *
     * @var array
     */
    protected $htmlAttributesRules = [];

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

    /**
     * Return the list of additional validation to be applied on the model attributes on update.
     *
     * @return array
     */
    public function getHtmlAttributesRules(): array
    {
        return $this->htmlAttributesRules;
    }
}
