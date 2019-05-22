<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HasHtmlAttributesContract;
use Belvedere\FormMaker\Traits\HtmlAttributes\HasHtmlAttributes;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class AbstractModel extends Eloquent implements HasHtmlAttributesContract
{
    use HasHtmlAttributes;

    /**
     * The default html attributes automatically assigned on creation.
     *
     * @var array
     */
    public $assignedAttributes = [];

    /**
     * The list of html attributes available for the model.
     *
     * @var array
     */
    protected $attributesAvailable = [
        'class',
        'data',
        'id',
        'role',
    ];

    /**
     * Additional validation to be applied on the model attributes on update.
     *
     * @var array
     */
    public $attributesRules = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_attributes' => 'array',
    ];

    /**
     * The current implementation of the HtmlAttributerContract
     *
     * @var mixed
     */
    protected $htmlAttributesProvider;

    /**
     * Transform the model to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    abstract public function toApi();
}
