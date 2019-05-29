<?php

namespace Belvedere\FormMaker\Models\Siblings;

use Belvedere\FormMaker\Contracts\Siblings\SiblingContract;
use Belvedere\FormMaker\Contracts\Resources\SiblingResourcerContract;
use Belvedere\FormMaker\Listeners\ValidateProperties;
use Belvedere\FormMaker\Models\Model;
use Belvedere\FormMaker\Traits\Ranking\InRanking;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Resources\Json\JsonResource;

class Sibling extends Model implements SiblingContract
{
    use InRanking;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => ValidateProperties::class,
    ];

    /**
     * Sibling constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.siblings_table', 'siblings');

        $this->setHtmlAttributesProvider();
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(SiblingResourcerContract::class, ['sibling' => $this]);
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the input who owns this sibling.
     * Alias of siblingable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function input(): MorphTo
    {
        return $this->siblingable();
    }

    /**
     * Get the model who owns this sibling.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    protected function siblingable(): MorphTo
    {
        return $this->morphTo();
    }
}