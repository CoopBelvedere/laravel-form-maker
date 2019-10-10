<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract;

trait HasLabel
{
    /**
     * Add a label to the parent model.
     *
     * @param string $text
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract
     */
    public function addLabel(string $text): LabelerContract
    {
        $label = $this->nodeRepositoryProvider->getInstanceOf($this, 'label');

        $label->withText($text)->save();

        return $label;
    }

    /**
     * Get the label.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function label(): MorphOne
    {
        return $this->morphOne(resolve(LabelerContract::class), 'nodable');
    }
}
