<?php


namespace Belvedere\FormMaker\Models\HtmlElements\Label;

use Belvedere\FormMaker\Contracts\HtmlElements\Label\LabelerContract;
use Belvedere\FormMaker\Contracts\Text\HasTextContract;
use Belvedere\FormMaker\Http\Resources\HtmlElement\Label\LabelResource;
use Belvedere\FormMaker\Models\HtmlElements\AbstractElement;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\Text\HasText;
use Illuminate\Http\Resources\Json\JsonResource;

class Labeler extends AbstractElement implements HasTextContract, LabelerContract
{
    use HasText;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('label'));
    }

    /**
     * Checkbox constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'for',
            'form',
        ]);
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return new LabelResource($this);
    }
}