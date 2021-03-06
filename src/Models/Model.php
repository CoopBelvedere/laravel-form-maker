<?php

namespace Belvedere\FormMaker\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Belvedere\FormMaker\Contracts\Models\ModelContract;
use Belvedere\FormMaker\Traits\HtmlAttributes\HasHtmlAttributes;

class Model extends Eloquent implements ModelContract
{
    use HasHtmlAttributes;

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
     * Model constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setHtmlAttributesProvider();
    }

    /**
     * Set the available html attributes on the model.
     *
     * @param array $attributes
     * @return void
     */
    public function addAvailableAttributes(array $attributes): void
    {
        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, $attributes);
    }

    /**
     * Save the model and return itself.
     *
     * @return \Belvedere\FormMaker\Contracts\Models\ModelContract
     */
    public function saveAndFirst(): ModelContract
    {
        $this->save();

        return $this;
    }
}
