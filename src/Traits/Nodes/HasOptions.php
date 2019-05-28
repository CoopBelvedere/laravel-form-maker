<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Listeners\DeleteNodes;
use Belvedere\FormMaker\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasOptions
{
    /**
     * Boot the listener.
     */
    protected static function bootHasOptions()
    {
        static::retrieved(function (Model $model) {
            $model->load('options');
        });

        static::deleted(function (Model $model) {
            event(new DeleteNodes($model));
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
            $option = $this->add('option')->withHtmlAttributes($optionValues);

            if (array_key_exists('text', $optionValues) && method_exists($option, 'withText')) {
                $option->withText($optionValues['text']);
            }

            $option->save();
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
        return $this->nodesQueryBuilder('option');
    }
}