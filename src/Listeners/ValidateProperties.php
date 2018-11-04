<?php

namespace Chess\FormMaker\Listeners;

use Chess\FormMaker\Services\ValidatorService;
use Illuminate\Database\Eloquent\Model;

class ValidateProperties
{
    /**
     * The model to validate.
     *
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * The validator service class.
     *
     * @var \Chess\FormMaker\Services\ValidatorService $validator
     */
    protected $validator;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     * @throws \Exception
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->validator = new ValidatorService();

        $this->handle();
    }

    /**
     * Handle the event.
     *
     * @return void
     * @throws \Exception
     */
    protected function handle(): void
    {
        $validator = $this->validator->validate($this->model);

        if ($validator->fails()) {
            throw new \Exception(implode(' ', $validator->errors()->all()));
        }
    }
}
