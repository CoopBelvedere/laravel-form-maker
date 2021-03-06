<?php

namespace Belvedere\FormMaker\Contracts\Models\Form;

use Belvedere\FormMaker\Contracts\Models\ModelContract;
use Belvedere\FormMaker\Http\Resources\Form\FormResource;
use Belvedere\FormMaker\Contracts\Traits\Nodes\HasNodesContract;

interface FormContract extends HasNodesContract, ModelContract
{
    /**
     * Specifies the form url action.
     *
     * @param string $action
     * @return \Belvedere\FormMaker\Contracts\Models\Form\FormContract
     */
    public function action(string $action): self;

    /**
     * Disable all inputs.
     *
     * @return void
     */
    public function disabled(): void;

    /**
     * Enable all inputs.
     *
     * @return void
     */
    public function enabled(): void;

    /**
     * Specifies the form http method.
     *
     * @param string $method
     * @return \Belvedere\FormMaker\Contracts\Models\Form\FormContract
     */
    public function method(string $method): self;

    /**
     * Return the form inputs rules in a form request format.
     *
     * @return array
     * @throws \Exception
     */
    public function rules(): array;

    /**
     * Transform the form to JSON.
     *
     * @return \Belvedere\FormMaker\Http\Resources\Form\FormResource
     */
    public function toApi(): FormResource;
}
