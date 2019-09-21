<?php

namespace Belvedere\FormMaker\Contracts\Form;

use Belvedere\FormMaker\Contracts\ModelContract;

interface FormContract extends ModelContract
{
    /**
     * Specifies the form url action.
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): FormContract;

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
     * @return self
     */
    public function method(string $method): FormContract;

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
    public function toApi();
}