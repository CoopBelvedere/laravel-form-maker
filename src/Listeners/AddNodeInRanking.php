<?php

namespace Belvedere\FormMaker\Listeners;

use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\InputContract;

class AddNodeInRanking
{
    /**
     * The node to be added in ranking.
     *
     * @var \Belvedere\FormMaker\Models\Nodes\Node
     */
    protected $node;

    /**
     * Create the event listener.
     *
     * @param \Belvedere\FormMaker\Models\Nodes\Node $node
     * @return void
     */
    public function __construct(Node $node)
    {
        $this->node = $node;

        $this->handle();
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    protected function handle(): void
    {
        if ($this->node->type === 'label' && $this->node->getRelation('parent') instanceof InputContract) {
            return;
        }

        $this->node->getRelation('parent')->addInRanking($this->node);
    }
}
