<?php

namespace Belvedere\FormMaker\Traits\Inputs;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;
use Belvedere\FormMaker\Listeners\DeleteChildren;
use Illuminate\Database\Eloquent\Model;
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
            event(new DeleteChildren($model));
        });
    }

    /**
     * Add a option input to the parent model.
     *
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract
     * @throws \Exception
     */
    protected function add(): OptionerContract
    {
        $option = $this->resolve('option');

        $option->type = 'option';

        $this->options()->save($option);

        $this->ranking->add($option);

        return $option;
    }

    /**
     * Resolve the input out of the service container.
     *
     * @param string $input
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract
     */
    protected function resolve(string $input): OptionerContract
    {
        return resolve(sprintf('form-maker.%s', $input));
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
            $option = $this->add()
                        ->withHtmlAttributes($optionValues);

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
        return $this->morphMany($this->resolve('option'), 'inputable');
    }
}
