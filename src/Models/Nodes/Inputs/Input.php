<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs;

use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Traits\Nodes\HasLabel;
use Belvedere\FormMaker\Traits\Rules\HasRules;
use Belvedere\FormMaker\Listeners\CascadeDelete;
use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Listeners\AssignAttributes;
use Belvedere\FormMaker\Traits\Rankings\HasRankings;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\InputContract;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Inputs\InputResourcerContract;

class Input extends Node implements InputContract
{
    use HasLabel, HasRankings, HasRules;

    /**
     * The default attributes automatically assigned on creation.
     *
     * @var array
     */
    protected $htmlAttributesAssigned = [
        'id',
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'html_attributes' => 'array',
        'rules' => 'array',
    ];

    /**
     * Add the custom eloquent events listeners.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($input) {
            new AssignAttributes($input);
        });

        static::deleting(function ($input) {
            new CascadeDelete($input);
        });
    }

    /**
     * Input constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'autocomplete',
            'autofocus',
            'disabled',
            'form',
            'name',
            'readonly',
            'required',
            'title',
            'value',
        ]);

        $this->setRankingProvider();

        $this->setRulesProvider();
    }

    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @return array
     */
    public function getHtmlAttributesAssigned(): array
    {
        return $this->htmlAttributesAssigned;
    }

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(InputResourcerContract::class, ['input' => $this]);
    }
}
