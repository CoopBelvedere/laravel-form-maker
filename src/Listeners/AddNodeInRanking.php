<?php

namespace Belvedere\FormMaker\Listeners;

use Belvedere\FormMaker\Models\Nodes\Node;

class AddNodeInRanking
{
    /**
     * The node to be added in ranking
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
        $this->node->parent->addInRanking($this->node);
    }
}
