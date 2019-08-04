<?php

namespace Belvedere\FormMaker\Models\Siblings;

use Belvedere\FormMaker\{
    Contracts\Siblings\SiblingContract,
    Contracts\Resources\SiblingResourcerContract,
    Models\Model,
    Traits\Rankings\InRanking
};
use Illuminate\{
    Database\Eloquent\Relations\MorphTo,
    Http\Resources\Json\JsonResource
};

class Sibling extends Model implements SiblingContract
{
    use InRanking;

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
     * Get the model who owns this sibling.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent(): MorphTo
    {
        return $this->morphTo('siblingable');
    }
}