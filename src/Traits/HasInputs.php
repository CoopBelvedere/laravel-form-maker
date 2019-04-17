<?php

namespace Chess\FormMaker\Traits;

use Chess\FormMaker\Listeners\DeleteInputs;
use Chess\FormMaker\Models\Form\Inputs\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait HasInputs
{
    use HasRanking;

    /**
     * Boot the listener.
     */
    protected static function bootHasInputs()
    {
        static::deleted(function (Model $model) {
            event(new DeleteInputs($model));
        });
    }

    /**
     * Add an input to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null)
    {
        $inputPath = $this->getInputPath($type);

        $input = new $inputPath;

        if ($name) {
            $input->withHtmlAttributes(['name' => $name]);
        }

        $this->inputsBuilder($type)->save($input);

        $this->ranking->add($input);

        return $input;
    }

    /**
     * Add an input after an other input.
     *
     * @param string $beforeInputName
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAfter(string $afterInputName, string $type, ?string $name = null)
    {
        $input = $this->add($type, $name);

        $afterInput = $this->getInput($afterInputName);

        if ($afterInput && $this->ranking->inRanking($afterInput)) {
            $this->ranking->move($input)->toRank($afterInput->rank + 1);
        }

        return $input;
    }

    /**
     * Add an input at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null)
    {
        $input = $this->add($type, $name);

        $this->ranking->move($input)->toRank($rank);

        return $input;
    }

    /**
     * Add an input before an other input.
     *
     * @param string $beforeInputName
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addBefore(string $beforeInputName, string $type, ?string $name = null)
    {
        $input = $this->add($type, $name);

        $beforeInput = $this->getInput($beforeInputName);

        if ($beforeInput && $this->ranking->inRanking($beforeInput)) {
            $this->ranking->move($input)->toRank($beforeInput->rank - 1);
        }

        return $input;
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
        $rawInputs = DB::table('inputs')->get()->groupBy('type')->toArray();

        foreach (array_keys($rawInputs) as $type) {
            $subset = $this->inputsBuilder($type)->get();
            $inputs = $inputs->merge($subset);
        }

        return $inputs;
    }

    /**
     * Get the input with the specified name property.
     *
     * @param string $name
     * @return Input|null
     * @throws \Exception
     */
    public function getInput(string $name): ?Input
    {
        return $this->inputs()
            ->firstWhere('html_attributes.name', $name);
    }

    /**
     * Get the class input full path.
     *
     * @param  string $input
     * @return string
     * @throws \Exception
     */
    protected function getInputPath(string $input): string
    {
        $className = 'Chess\\FormMaker\\Models\\Form\\Inputs\\' . ucfirst($input);

        if (class_exists($className)) {
            return $className;
        }

        throw new \Exception('This input is not supported');
    }

    /**
     * Get the model inputs with their rank.
     *
     * @param string $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(string $type = ''): Collection
    {
        if ($type) {
            $inputs = $this->inputsBuilder($type)->get();
        } else {
            $inputs = $this->getAllInputs();
        }

        return $inputs->map(function ($input) {
            $input->rank = $this->ranking->rank($input->id);
            return $input;
        })->sortBy('rank');
    }

    /**
     * Get the model inputs query builder.
     *
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * @throws \Exception
     */
    protected function inputsBuilder(string $type): MorphMany
    {
        return $this->morphMany($this->getInputPath($type), 'inputable');
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
