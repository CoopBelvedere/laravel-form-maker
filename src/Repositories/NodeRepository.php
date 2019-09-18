<?php

namespace Belvedere\FormMaker\Repositories;

use Belvedere\FormMaker\Models\{
    Model,
    Nodes\Node
};

class NodeRepository
{
    /**
     * The list of the nodes available.
     *
     * @var array
     */
    const NODES = [
        // Inputs
        'checkbox' => \Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract::class,
        'color' => \Belvedere\FormMaker\Contracts\Inputs\Color\ColorerContract::class,
        'datalist' => \Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract::class,
        'date' => \Belvedere\FormMaker\Contracts\Inputs\Date\DaterContract::class,
        'email' => \Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract::class,
        'file' => \Belvedere\FormMaker\Contracts\Inputs\File\FilerContract::class,
        'image' => \Belvedere\FormMaker\Contracts\Inputs\Image\ImagerContract::class,
        'month' => \Belvedere\FormMaker\Contracts\Inputs\Month\MontherContract::class,
        'number' => \Belvedere\FormMaker\Contracts\Inputs\Number\NumberContract::class,
        'option' => \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract::class,
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
        // Siblings
        'label' => \Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract::class,
        'paragraph' => \Belvedere\FormMaker\Contracts\Siblings\Paragraph\ParagrapherContract::class,
    ];

    public function all()
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
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function create(Model $parent, string $type): Node
    {
        $node = $this->resolve($type);

        $node->type = $type;

        $parent->morphMany($node, 'nodable')->save($node);

        return $node;
    }

    /**
     * Get the node with the specified id.
     *
     * @param \Belvedere\FormMaker\Models\Model $model
     * @param mixed $key
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function find(Model $model, $key, $columns = ['*']): Node
    {
        return new Node();
    }

    /**
     * Resolve the node out of the service container.
     *
     * @param string $node
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    protected function resolve(string $node): Node
    {
        if (array_key_exists($node, self::NODES)) {
            return resolve(self::NODES[$node]);
        }

        return resolve(sprintf('form-maker.%s', $node));
    }
}