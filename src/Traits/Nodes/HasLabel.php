<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\{
    Contracts\Repositories\NodeRepositoryContract,
    Contracts\Siblings\Label\LabelerContract
};

trait HasLabel
{
    /**
     * Add a label to the parent model.
     *
     * @param string|null $text
     * @return \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract|null
     */
    public function addLabel(?string $text = null): ?LabelerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $label = $nodeRepository->create($this, 'label');

        if ($text) {
            $label->withText($text)->save();
        }

        return $label;
    }

    /**
     * Get the node label.
     *
     * @return \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract|null
     */
    public function label(): ?LabelerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $label = $nodeRepository->first($this, 'label');

        return is_null($label) ? null : $label;
    }
}
