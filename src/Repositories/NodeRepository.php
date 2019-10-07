<?php

namespace Belvedere\FormMaker\Repositories;

use Illuminate\Support\Facades\DB;
use Belvedere\FormMaker\Models\Model;
use Illuminate\Support\LazyCollection;
use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;

class NodeRepository implements NodeRepositoryContract
{
    /**
     * The list of the nodes available.
     *
     * @var array
     */
    const NODES = [
        // Inputs
        'checkbox' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Checkbox\CheckboxerContract::class,
        'color' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Color\ColorerContract::class,
        'datalist' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Datalist\DatalisterContract::class,
        'date' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Date\DaterContract::class,
        'email' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Email\EmailerContract::class,
        'file' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\File\FilerContract::class,
        'image' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Image\ImagerContract::class,
        'month' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Month\MontherContract::class,
        'number' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Number\NumberContract::class,
        'option' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract::class,
        'password' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Password\PassworderContract::class,
        'radio' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Radio\RadioerContract::class,
        'range' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Range\RangerContract::class,
        'search' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Search\SearcherContract::class,
        'select' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Select\SelecterContract::class,
        'tel' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Tel\TelerContract::class,
        'text' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Text\TexterContract::class,
        'textarea' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Textarea\TextareaerContract::class,
        'time' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Time\TimerContract::class,
        'url' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Url\UrlerContract::class,
        'week' => \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Week\WeekerContract::class,
        // Siblings
        'label' => \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract::class,
        'paragraph' => \Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Paragraph\ParagrapherContract::class,
    ];

    /**
     * Get the model nodes filtered by type or not.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection
     */
    public function all(Model $parent, ?string $type = null): LazyCollection
    {
        $query = DB::table(config('form-maker.database.form_nodes_table', 'form_nodes'))
            ->where('nodable_type', $parent->getMorphClass())
            ->where('nodable_id', $parent->getKey())
            ->orderBy('type');

        if ($type === 'inputs' || $type === 'siblings') {
            $query->whereIn('type', array_keys(config('form-maker.nodes')[$type]));
        } elseif ($type) {
            $query->where('type', $type);
        }

        return $query->cursor()->groupBy('type')->map(function ($nodes, $key) {
            return $this->resolve($nodes[0]->type)::hydrate($nodes->toArray());
        })->flatten(1);
    }

    /**
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @param array $attributes
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function create(Model $parent, string $type, array $attributes = []): Node
    {
        $node = $this->resolve($type);

        $this->hydrate([$node]);

        $node->type = $type;

        if (count($attributes) > 0) {
            $node->withHtmlAttributes($attributes);
        }

        $parent->morphMany($node, 'nodable')->save($node);

        return $node;
    }

    /**
     * Delete all nodes of the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @return mixed
     */
    public function delete(Model $parent)
    {
        return DB::table(config('form-maker.database.form_nodes_table', 'form_nodes'))
            ->where('nodable_type', $parent->getMorphClass())
            ->where('nodable_id', $parent->getKey())
            ->delete();
    }

    /**
     * Get the node with the specified id.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param mixed $nodeKey
     * @param array $columns
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function find(Model $parent, $nodeKey, array $columns): ?Node
    {
        $query = DB::table(config('form-maker.database.form_nodes_table', 'form_nodes'))
            ->where('nodable_type', $parent->getMorphClass())
            ->where('nodable_id', $parent->getKey());

        if (count($columns) > 0) {
            $query->where(function ($query) use ($columns, $nodeKey) {
                foreach ($columns as $key => $column) {
                    if ($key === 0) {
                        $query->where(sprintf('html_attributes->%s', $column), $nodeKey);
                    } else {
                        $query->orWhere(sprintf('html_attributes->%s', $column), $nodeKey);
                    }
                }
            });
        }

        $node = $query->first();

        return (is_null($node)) ? $node : $this->resolve($node->type)::hydrate([$node])[0];
    }

    /**
     * Get the first node in list.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function first(Model $parent, ?string $type = null): ?Node
    {
        $query = DB::table(config('form-maker.database.form_nodes_table', 'form_nodes'))
            ->where('nodable_type', $parent->getMorphClass())
            ->where('nodable_id', $parent->getKey());

        if (is_string($type)) {
            $query->where('type', $type);
        }

        $node = $query->first();

        return (is_null($node)) ? $node : $this->resolve($node->type)::hydrate([$node])[0];
    }

    protected function hydrate(array $nodes)
    {
        dd($nodes[0]->type);
        if (count($nodes) === 0) {
            return null;
        }

        $type = $nodes[0]->type;
        // $this->resolve($nodes[0]->type)::hydrate($nodes->toArray())
        // $this->resolve($node->type)::hydrate([$node])[0]
        // $this->resolve($node->type)::hydrate([$node])[0]
        return true;
    }

    /**
     * Resolve the node out of the service container.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    protected function resolve(string $type): Node
    {
        if (array_key_exists($type, self::NODES)) {
            return resolve(self::NODES[$type]);
        }

        return resolve(sprintf('form-maker.%s', $type));
    }
}
