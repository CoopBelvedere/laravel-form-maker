<?php

namespace Belvedere\FormMaker\Traits\Nodes;

trait HasNodes
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null)
    {
        $node = $this->resolve($type);

        $node->type = $type;

        if ($name) {
            $node->withHtmlAttributes(['name' => $name]);
        }

        $this->nodeQueryBuilder($type)->save($node);

        $this->ranking->add($node);

        return $node;
    }

    /**
     * Add a node after an other node.
     *
     * @param string $afterNodeKey
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null)
    {
        $node = $this->add($type, $name);

        $afterNode = $this->getNode($type, $afterNodeKey);

        if ($afterNode && $this->ranking->inRanking($afterNode)) {
            $this->ranking->move($node)->toRank($afterNode->rank + 1);
        }

        return $node;
    }

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null)
    {
        $node = $this->add($type, $name);

        $this->ranking->move($node)->toRank($rank);

        return $node;
    }

    /**
     * Add a node before an other node.
     *
     * @param string $beforeNodeKey
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null)
    {
        $node = $this->add($type, $name);

        $beforeNode = $this->getNode($type, $beforeNodeKey);

        if ($beforeNode && $this->ranking->inRanking($beforeNode)) {
            $this->ranking->move($node)->toRank($beforeNode->rank - 1);
        }

        return $node;
    }

    /**
     * Get the node with the specified key property.
     *
     * @param string $node
     * @param string $nodeKey
     * @return mixed
     */
    protected function getNode(string $node, string $nodeKey)
    {
        if ($node === 'option') {
            return true;

        } else if (in_array($node, config('nodes.html_elements'))) {
            return $this->getHtmlElement($nodeKey);

        } else if (in_array($node, config('nodes.inputs'))) {
            return $this->getInput($nodeKey);
        }
    }

    /**
     * Get the node query builder.
     *
     * @param string $node
     * @return mixed
     */
    protected function nodeQueryBuilder(string $node)
    {
        if ($node === 'option') {
            return $this->options();

        } else if (in_array($node, config('nodes.html_elements'))) {
            return $this->htmlElementQueryBuilder($node);

        } else if (in_array($node, config('nodes.inputs'))) {
            return $this->inputQueryBuilder($node);
        }
    }

    /**
     * Resolve the node out of the service container.
     *
     * @param string $node
     * @return mixed
     */
    protected function resolve(string $node)
    {
        return resolve(sprintf('form-maker.%s', $node));
    }
}