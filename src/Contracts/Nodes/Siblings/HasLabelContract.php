<?php

namespace Belvedere\FormMaker\Contracts\Nodes\Siblings;

use Belvedere\FormMaker\{
    Contracts\Rankings\HasRankingsContract,
    Contracts\Siblings\Label\LabelerContract
};

interface HasLabelContract extends HasRankingsContract
{
    /**
     * Add a label to the parent model.
     *
     * @param string|null $text
     * @return \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract|null
     */
    public function addLabel(?string $text = null): ?LabelerContract;

    /**
     * Get the node label.
     *
     * @return \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract|null
     */
    public function label(): ?LabelerContract;
}