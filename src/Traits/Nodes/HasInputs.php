<?php


namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Listeners\DeleteNodes;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Models\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait HasInputs
{
    /**
     * Boot the listener.
     */
    protected static function bootHasInputs()
    {
        static::deleted(function (Model $model) {
            event(new DeleteNodes($model));
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
            $subset = $this->nodesQueryBuilder($input->type)->get();
            $inputs = $inputs->merge($subset);
        }

        return $inputs;
    }

    /**
     * Get the input with the specified name property.
     * Alias of getNode
     *
     * @param string $name
     * @return \Belvedere\FormMaker\Models\Inputs\Input|null
     * @throws \Exception
     */
    public function getInput(string $name): ?Input
    {
        return $this->getNode($name);
    }

    /**
     * Get the model inputs sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(?string $type = null): Collection
    {
        if (is_null($type)) {
            $inputs = $this->getAllInputs();
        } else {
            $inputs = $this->nodesQueryBuilder($type)->get();
        }

        return $inputs->map(function ($input) {
            $input->rank = $this->ranking()->first()->rank($input->id);
            return $input;
        })->sortBy('rank');
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