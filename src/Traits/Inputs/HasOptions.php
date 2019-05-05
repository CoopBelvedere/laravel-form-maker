<?php

namespace Belvedere\FormMaker\Traits\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasOptions
{
    use HasInputs;

    /**
     * Boot the listener.
     */
    protected static function bootHasOptions()
    {
        static::retrieved(function (Model $model) {
            $model->load('options');
        });
    }

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return self
     * @throws \Exception
     */
    public function withOptions(array ...$options): self
    {
        foreach ($options as $optionValues)
        {
            $this->add('option')
                ->withHtmlAttributes($optionValues)
                ->save();
        }

        return $this;
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the options that belongs to the input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function options(): MorphMany
    {
        return $this->morphMany('Belvedere\FormMaker\Models\Form\Inputs\Option', 'inputable');
    }
}
