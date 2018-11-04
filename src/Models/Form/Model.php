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
     * Mass assign rules to a property.
     *
     * @param string $property
     * @param array $rules
     * @return self
     */
    public function assign(string $property, array $rules): self
    {
        foreach ($rules as $rule => $arguments) {
            $this->assignToElement($property, $rule, $arguments);
        }
        return $this;
    }

    /**
     * Assign the rule to the property.
     *
     * @param string $property
     * @param string $rule
     * @param mixed $arguments
     * @return void
     */
    protected function assignToElement(string $property, string $rule, $arguments): void
    {
        $method = camel_case(sprintf('%s_%s', str_singular($property), $rule));

        if (method_exists($this, $method)) {
            if (is_null($arguments)) {
                $this->$method(null);
            } else if ($arguments === $rule) {
                $this->$method();
            } else {
                $this->$method(...array_wrap($arguments));
            }
        }
    }

    /**
     * Mass removal of assign rules to a property.
     *
     * @param string $property
     * @param array $rules
     * @return self
     */
    public function remove(string $property, array $rules): self
    {
        foreach ($rules as $rule) {
            $this->assignToElement($property, $rule, null);
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
