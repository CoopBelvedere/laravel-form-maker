<?php

namespace Belvedere\FormMaker\Models\HtmlElements;

use Belvedere\FormMaker\Contracts\HtmlElements\ElementsContract;
use Belvedere\FormMaker\Contracts\Inputs\InputsContract;
use Belvedere\FormMaker\Contracts\Resources\ElementResourcerContract;
use Belvedere\FormMaker\Listeners\ValidateProperties;
use Belvedere\FormMaker\Models\Form\AbstractModel;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractElement extends AbstractModel implements ElementsContract
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => ValidateProperties::class,
    ];

    /**
     * AbstractElement constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.html_elements_table', 'html_elements');

        $this->setHtmlAttributesProvider();
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(ElementResourcerContract::class, ['element' => $this]);
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the input who owns this element.
     * Alias of elementable.
     *
     * @return \Belvedere\FormMaker\Contracts\Inputs\InputsContract
     */
    public function input(): InputsContract
    {
        return $this->elementable;
    }

    /**
     * Get the model who owns this element.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    protected function elementable(): MorphTo
    {
        return $this->morphTo();
    }
}