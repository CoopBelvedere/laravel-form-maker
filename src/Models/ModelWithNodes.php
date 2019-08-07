<?php

namespace Belvedere\FormMaker\Models;

use Belvedere\FormMaker\{
    Contracts\Nodes\WithNodesContract,
    Contracts\Rankings\HasRankingsContract,
    Listeners\DeleteRelatedModels,
    Traits\HasRankings
};
use Illuminate\Support\{
    Collection,
    Facades\DB
};

abstract class ModelWithNodes extends Model implements HasRankingsContract, WithNodesContract
{
    use HasRankings;

    /**
     * Mapping of the nodes name and their contract.
     *
     * @var array
     */
    const CONTRACTS = [
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

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleting' => DeleteRelatedModels::class,
    ];

    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Model
    {
        $node = $this->resolve($type);

        $node->type = $type;

        if ($name) {
            $node->withHtmlAttributes(['name' => $name]);
        }

        $this->nodesQueryBuilder($type)->save($node);

        $this->addInRanking($node);

        return $node;
    }

    /**
     * Add a node after another node.
     *
     * @param string $afterNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $afterNode = $this->getNode($afterNodeKey);

        if ($afterNode && $this->getRanking($node->getTable())->inRanking($afterNode)) {
            $this->getRanking($node->getTable())->move($node)->toRank($afterNode->rank + 1);
        }

        return $node;
    }

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $this->getRanking($node->getTable())->move($node)->toRank($rank);

        return $node;
    }

    /**
     * Add a node before another node.
     *
     * @param string $beforeNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $beforeNode = $this->getNode($beforeNodeKey);

        if ($beforeNode && $this->getRanking($node->getTable())->inRanking($beforeNode)) {
            $this->getRanking($node->getTable())->move($node)->toRank($beforeNode->rank - 1);
        }

        return $node;
    }

    /**
     * Get all the model nodes.
     *
     * @param string $table
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getAllNodes(string $table): Collection
    {
        $nodes = collect([]);

        foreach (DB::table(config(sprintf('form-maker.database.%s_table', $table), $table))
                     ->select('type')
                     ->distinct()
                     ->cursor() as $element)
        {
            $subset = $this->nodesQueryBuilder($element->type)->get();
            $nodes = $nodes->merge($subset);
        }

        return $nodes;
    }

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return mixed
     */
    abstract protected function getNode(string $nodeKey);

    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string $table
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getNodes(string $table, ?string $type = null): Collection
    {
        if (is_null($type)) {
            $nodes = $this->getAllNodes($table);
        } else {
            $nodes = $this->nodesQueryBuilder($type)->get();
        }

        if ($nodes->isEmpty()) {
            return $nodes;
        }

        return $this->getRanking($table)->sortByRank($nodes);
    }

    /**
     * Get the model nodes query builder.
     *
     * @param mixed $node
     * @return mixed
     */
    abstract protected function nodesQueryBuilder($node);

    /**
     * Resolve the node out of the service container.
     *
     * @param string $node
     * @return \Belvedere\FormMaker\Models\Model
     */
    protected function resolve(string $node): Model
    {
        if (array_key_exists($node, self::CONTRACTS)) {
            return resolve(self::CONTRACTS[$node]);
        }

        return resolve(sprintf('form-maker.%s', $node));
    }
}