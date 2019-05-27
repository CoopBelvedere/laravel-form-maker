<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Listeners\DeleteNodes;
use Belvedere\FormMaker\Models\HtmlElements\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait HasHtmlElements
{
    use HasNodes;

    /**
     * Boot the listener.
     */
    protected static function bootHasElements()
    {
        static::deleted(function (Model $model) {
            event(new DeleteNodes($model, 'htmlElements'));
        });
    }

    /**
     * Get the element query builder.
     *
     * @param string $element
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * @throws \Exception
     */
    protected function htmlElementQueryBuilder(string $element): MorphMany
    {
        return $this->morphMany($this->resolve($element), 'elementable');
    }

    /**
     * Get the model elements.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getAllHtmlElements(): Collection
    {
        $elements = collect([]);

        foreach (DB::table(config('form-maker.database.html_elements_table', 'html_elements'))
                     ->select('type')
                     ->distinct()
                     ->cursor() as $element)
        {
            $subset = $this->htmlElementQueryBuilder($element->type)->get();
            $elements = $elements->merge($subset);
        }

        return $elements;
    }

    /**
     * Get the element with the specified type property.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\HtmlElements\Element|null
     * @throws \Exception
     */
    public function getHtmlElement(string $type): ?Element
    {
        return $this->htmlElements()->firstWhere('type', $type);
    }

    /**
     * Get the model inputs sorted by their position in the ranking.
     *
     * @param string $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function htmlElements(string $type = ''): Collection
    {
        if ($type) {
            $elements = $this->htmlElementQueryBuilder($type)->get();
        } else {
            $elements = $this->getAllHtmlElements();
        }

        return $elements->map(function ($element) {
            $element->rank = $this->ranking->rank($element);
            return $element;
        })->sortBy('rank');
    }
}