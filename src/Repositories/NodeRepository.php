<?php

namespace Belvedere\FormMaker\Repositories;

use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract;
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
        $nodesTable = config('form-maker.database.form_nodes_table', 'form_nodes');

        $query = DB::table($nodesTable)
            ->select(DB::raw(sprintf('%s.*, label.id as label_id, label.nodable_type as label_nodable_type, label.nodable_id as label_nodable_id, label.text as label_text, label.html_attributes as label_html_attributes, label.rules as label_rules, label.created_at as label_created_at, label.updated_at as label_updated_at', $nodesTable)))
            ->leftJoin(DB::raw(sprintf('%s as label', $nodesTable)), function ($join) use ($nodesTable) {
                $join->on(sprintf('%s.id', $nodesTable), '=', 'label.nodable_id')
                    ->where('label.type', '=', 'label');
            })
            ->where(sprintf('%s.nodable_type', $nodesTable), $parent->getMorphClass())
            ->where(sprintf('%s.nodable_id', $nodesTable), $parent->getKey())
            ->orderBy(sprintf('%s.type', $nodesTable));

        if ($type === 'inputs' || $type === 'siblings') {
            $query->whereIn(sprintf('%s.type', $nodesTable), array_keys(config('form-maker.nodes')[$type]));
        } elseif ($type) {
            $query->where(sprintf('%s.type', $nodesTable), $type);
        }

        $query->get()->map(function ($node, $key) {
            $label = $this->hydrateLabel($node);
            $this->removeAttributes('label', $node);
            $node = $this->hydrate($node);
            $node->setRelation('label', $label);
            dd($node);
        });
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

        return (is_null($node)) ? $node : $this->hydrate($node);
    }

    /**
     * Get a new instance of a node model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function getInstanceOf(Model $parent, string $type): Node
    {
        $node = $this->resolve($type);

        $node->type = $type;
        $node->nodable_type = $parent->getMorphClass();
        $node->nodable_id = $parent->getKey();
        $node->setParentRelation($parent);

        return $node;
    }

    /**
     * Hydrate the label columns in the node object to a Label model.
     *
     * @param object $node
     * @return LabelerContract|null
     */
    protected function hydrateLabel(object $node): ?LabelerContract
    {
        if ($node->label_id) {
            return $this->hydrate((object) [
                'id' => $node->label_id,
                'nodable_type' => $node->label_nodable_type,
                'nodable_id' => $node->label_nodable_id,
                'type' => 'label',
                'text' => $node->label_text,
                'html_attributes' => $node->label_html_attributes,
                'rules' => $node->label_rules,
                'created_at' => $node->label_created_at,
                'updated_at' => $node->label_updated_at,
            ]);
        }

        return null;
    }

    /**
     * Create a laravel model from stdClass object.
     *
     * @param object $node
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    protected function hydrate(object $node): ?Node
    {
        if (is_null($node->type)) {
            return null;
        }

        $type = $node->type;

        return $this->resolve($type)::hydrate([$node])->shift();
    }

    /**
     * Remove attributes that start with a given prefix.
     *
     * @param string $prefix
     * @param object $node
     * @return void
     */
    protected function removeAttributes(string $prefix, object &$node): void
    {
        foreach ($node as $key => $value) {
            if (substr($key, 0, strlen($prefix)) === $prefix) {
                unset($node->$key);
            }
        }
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
