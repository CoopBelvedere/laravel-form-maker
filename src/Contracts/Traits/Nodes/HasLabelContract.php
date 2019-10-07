<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

use Belvedere\FormMaker\Contracts\Traits\Rankings\HasRankingsContract;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface HasLabelContract extends HasRankingsContract
{
    /**
     * Add a label to the parent model.
     *
     * @param string $text
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract
     */
    public function addLabel(string $text): LabelerContract;

    /**
     * Get the label.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function label(): MorphOne;
}
