<?php

namespace Chess\FormMaker\Traits;

use Chess\FormMaker\Listeners\DeleteInputs;
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
            $input->withHtmlProperties(['name' => $name]);
        }

        $this->inputsBuilder($type)->save($input);

        return $input;
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
     * @param  string $name
     * @return mixed|bool
     * @throws \Exception
     */
    public function getInput(string $name): ?string
    {
        return $this->inputs()
            ->firstWhere('html_properties.name', $name);
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
        });
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
}
