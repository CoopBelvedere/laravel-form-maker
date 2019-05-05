<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HasHtmlAttributesContract;
use Belvedere\FormMaker\Traits\HtmlAttributes\HasHtmlAttributes;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class AbstractNode extends Eloquent implements HasHtmlAttributesContract
{
    use HasHtmlAttributes;

    /**
     * The default attributes automatically assigned on creation.
     *
     * @var array
     */
    public $assignedAttributes = [];

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
     * The model position in the ranking.
     *
     * @var int
     */
    public $rank = 0;

    // HELPERS
    // ==============================================================

    /**
     * Get the model class name.
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getClassName(): string
    {
        $class = new \ReflectionClass($this);

        return strtolower($class->getShortName());
    }

    /**
     * Get the model class full path.
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getModelPath(): string
    {
        $class = new \ReflectionClass($this);

        return $class->getName();
    }
}
