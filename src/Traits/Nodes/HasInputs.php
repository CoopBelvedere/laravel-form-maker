<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Listeners\DeleteNodes;
use Belvedere\FormMaker\Models\Inputs\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait HasInputs
{
    use HasNodes;

    /**
     * Boot the listener.
     */
    protected static function bootHasInputs()
    {
        static::deleted(function (Model $model) {
            event(new DeleteNodes($model, 'inputs'));
        });
    }

    /**
     * Disable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function disabled(): void
    {
        $this->setInputUsability('disabled');
    }

    /**
     * Enable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function enabled(): void
    {
        $this->setInputUsability();
    }

    /**
     * Get the model inputs.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getAllInputs(): Collection
    {
        $inputs = collect([]);

        foreach (DB::table(config('form-maker.database.inputs_table', 'inputs'))
                     ->select('type')
                     ->distinct()
                     ->cursor() as $input)
        {
            $subset = $this->inputQueryBuilder($input->type)->get();
            $inputs = $inputs->merge($subset);
        }

        return $inputs;
    }

    /**
     * Get the input with the specified name property.
     *
     * @param string $name
     * @return \Belvedere\FormMaker\Models\Inputs\Input|null
     * @throws \Exception
     */
    public function getInput(string $name): ?Input
    {
        return $this->inputs()->firstWhere('html_attributes.name', $name);
    }

    /**
     * Get the model inputs sorted by their position in the ranking.
     *
     * @param string $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(string $type = ''): Collection
    {
        if ($type) {
            $inputs = $this->inputQueryBuilder($type)->get();
        } else {
            $inputs = $this->getAllInputs();
        }

        return $inputs->map(function ($input) {
            $input->rank = $this->ranking->rank($input);
            return $input;
        })->sortBy('rank');
    }

    /**
     * Get the input query builder.
     *
     * @param string $input
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * @throws \Exception
     */
    protected function inputQueryBuilder(string $input): MorphMany
    {
        return $this->morphMany($this->resolve($input), 'inputable');
    }

    /**
     * Set whether the inputs are disabled or not.
     *
     * @param string|null $disabled
     * @throws \Exception
     */
    protected function setInputUsability(?string $disabled = null): void
    {
        foreach ($this->inputs() as $input) {
            $input->withHtmlAttributes(['disabled' => $disabled])->save();
        }
    }
}