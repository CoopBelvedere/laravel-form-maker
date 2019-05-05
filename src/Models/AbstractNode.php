<?php

namespace Belvedere\FormMaker\Models\Form;

use Belvedere\FormMaker\Traits\Attributes\HasGlobalAttributes;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;

abstract class AbstractNode extends Eloquent
{
    use HasGlobalAttributes;

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

    /**
     * Assign the rule or html property to the input.
     *
     * @param string $type
     * @param string $assignment
     * @param mixed $arguments
     * @return void
     */
    protected function assignToInput(string $type, string $assignment, $arguments): void
    {
        $method = Str::camel(sprintf('%s_%s', $type, $assignment));

        if (method_exists($this, $method)) {
            if (is_null($arguments)) {
                $this->$method(null);
            } else if ($arguments === $assignment) {
                $this->$method();
            } else {
                $this->$method(...array_wrap($arguments));
            }
        }
    }

    /**
     * Mass removal of html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function removeHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $attribute) {
            $this->assignToInput('html', $attribute, null);
        }
        return $this;
    }

    /**
     * Set the model html attributes.
     *
     * @param  array $attributes
     * @return void
     */
    public function setHtmlAttributesAttribute(array $attributes): void
    {
        if (isset($this->attributes['html_attributes'])) {
            $attributes = $this->removeNullValues(
                array_merge($this->html_attributes, $attributes)
            );
        }
        $this->attributes['html_attributes'] = json_encode($attributes);
    }

    /**
     * Serialise the model to an api friendly format.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    abstract protected function toApi();

    /**
     * Mass assign html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function withHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $name => $arguments) {
            $this->assignToInput('html', $name, $arguments);
        }
        return $this;
    }

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

    /**
     * Remove the null values in array.
     *
     * @param  array $items
     * @return array
     */
    protected function removeNullValues(array $items): array
    {
        return array_filter($items, function ($item) {
            return !is_null($item);
        });
    }
}