<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

use Belvedere\FormMaker\Contracts\{
    Models\Nodes\Siblings\Label\LabelerContract,
    Traits\Rankings\HasRankingsContract
};

interface HasLabelContract extends HasRankingsContract
{
    /**
     * Add a label to the parent model.
     *
     * @param string $text
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract
     */
    public function addLabel(string $text): ?LabelerContract;

    /**
     * Get the node label.
     *
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract|null
     */
    public function label(): ?LabelerContract;
}