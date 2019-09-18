<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\{
    Listeners\CascadeDelete,
    Models\Model,
    Models\Nodes\Node
};
use Illuminate\Support\Collection;

trait HasNodes
{
    /**
     * Boot the listener.
     */
    protected static function bootHasNodes()
    {
        static::deleting(function (Model $model) {
            event(new CascadeDelete($model));
        });
    }

    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Node
    {
        $node = $this->resolve($type);

        $node->type = $type;

        $node->component = 'input'; // test

        if ($name) {
            $node->withHtmlAttributes(['name' => $name]);
        }

        $this->morphMany($node, 'nodable')->save($node);

        $this->addInRanking($node);

        return $node;
    }

    /**
     * Add a node after another node.
     *
     * @param mixed $afterNodeId
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAfter($afterNodeId, string $type, ?string $name = null): Node
    {
        $node = $this->add($type, $name);

        $afterNode = $this->getNode($afterNodeId);

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
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Node
    {
        $node = $this->add($type, $name);

        $this->ranking->move($node)->toRank($rank);

        return $node;
    }

    /**
     * Add a node before another node.
     *
     * @param mixed $beforeNodeId
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addBefore($beforeNodeId, string $type, ?string $name = null): Node
    {
        $node = $this->add($type, $name);

        $beforeNode = $this->getNode($beforeNodeId);

        if ($beforeNode && $this->ranking->inRanking($beforeNode)) {
            $this->ranking->move($node)->toRank($beforeNode->rank - 1);
        }

        return $node;
    }

    /**
     * Get the node with the specified id.
     *
     * @param mixed $id
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function getNode($id): Node
    {
        // return $this->siblings()->firstWhere('type', $nodeKey);
        return new Node();
    }

    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string $table
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getNodes(string $table, ?string $type = null): Collection
    {
        $nodes = $this->getRelations();
        // pass the relations in with
        // regroup them into node family

        dd($nodes);
//        if (is_null($type)) {
//            $nodes = $this->nodesQueryBuilder($type)->get();
//        }
//
//        if ($nodes->isEmpty()) {
//            return $nodes;
//        }
//
//        return $this->getRanking($table)->sortByRank($nodes);
    }

    /**
     * Resolve the node out of the service container.
     *
     * @param string $node
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    protected function resolve(string $node): Node
    {
        $contracts = [
            'checkbox' => \Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract::class,
            'color' => \Belvedere\FormMaker\Contracts\Inputs\Color\ColorerContract::class,
            'datalist' => \Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract::class,
            'date' => \Belvedere\FormMaker\Contracts\Inputs\Date\DaterContract::class,
            'email' => \Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract::class,
            'file' => \Belvedere\FormMaker\Contracts\Inputs\File\FilerContract::class,
            'image' => \Belvedere\FormMaker\Contracts\Inputs\Image\ImagerContract::class,
            'label' => \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract::class,
            'month' => \Belvedere\FormMaker\Contracts\Inputs\Month\MontherContract::class,
            'number' => \Belvedere\FormMaker\Contracts\Inputs\Number\NumberContract::class,
            'option' => \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract::class,
            'paragraph' => \Belvedere\FormMaker\Contracts\Siblings\Paragraph\ParagrapherContract::class,
            'password' => \Belvedere\FormMaker\Contracts\Inputs\Password\PassworderContract::class,
            'radio' => \Belvedere\FormMaker\Contracts\Inputs\Radio\RadioerContract::class,
            'range' => \Belvedere\FormMaker\Contracts\Inputs\Range\RangerContract::class,
            'search' => \Belvedere\FormMaker\Contracts\Inputs\Search\SearcherContract::class,
            'select' => \Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract::class,
            'tel' => \Belvedere\FormMaker\Contracts\Inputs\Tel\TelerContract::class,
            'text' => \Belvedere\FormMaker\Contracts\Inputs\Text\TexterContract::class,
            'textarea' => \Belvedere\FormMaker\Contracts\Inputs\Textarea\TextareaerContract::class,
            'time' => \Belvedere\FormMaker\Contracts\Inputs\Time\TimerContract::class,
            'url' => \Belvedere\FormMaker\Contracts\Inputs\Url\UrlerContract::class,
            'week' => \Belvedere\FormMaker\Contracts\Inputs\Week\WeekerContract::class,
        ];

        if (array_key_exists($node, $contracts)) {
            return resolve($contracts[$node]);
        }

        return resolve(sprintf('form-maker.%s', $node));
    }
}