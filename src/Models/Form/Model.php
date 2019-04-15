<?php

namespace Chess\FormMaker\Models\Form;

use Chess\FormMaker\Traits\Properties\GlobalProperties;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    use GlobalProperties;

    /**
     * Additional rules for the model.
     *
     * @var array
     */
    public $additionalRules = [];

    /**
     * The default properties automatically assigned on creation.
     *
     * @var array
     */
    public $assignedProperties = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_properties' => 'array',
    ];

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
        $method = camel_case(sprintf('%s_%s', str_singular($type), $assignment));

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
     * Mass removal of html properties to a model.
     *
     * @param array $properties
     * @return self
     */
    public function removeProperties(array $properties): self
    {
        foreach ($properties as $property) {
            $this->assignToInput('properties', $property, null);
        }
        return $this;
    }

    /**
     * Set the model html properties.
     *
     * @param  array $properties
     * @return void
     */
    public function setHtmlPropertiesAttribute(array $properties): void
    {
        if (isset($this->attributes['html_properties'])) {
            $properties = $this->removeNullValues(
                array_merge($this->html_properties, $properties)
            );
        }
        $this->attributes['html_properties'] = json_encode($properties);
    }

    /**
     * Mass assign html properties to a model.
     *
     * @param array $properties
     * @return self
     */
    public function withProperties(array $properties): self
    {
        foreach ($properties as $name => $arguments) {
            $this->assignToInput('properties', $name, $arguments);
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
