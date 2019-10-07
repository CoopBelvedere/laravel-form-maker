<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;
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
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $label = $nodeRepository->getInstanceOf($this, 'label');

        $label->withText($text)->save();

        return $label;
    }

    /**
     * Get the label.
     *
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract|null
     */
    public function label(): ?LabelerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $label = $nodeRepository->first($this, 'label');

        return is_null($label) ? null : $label;
    }
}
