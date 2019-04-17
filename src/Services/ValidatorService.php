<?php

namespace Chess\FormMaker\Services;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ValidatorService
{
    /**
     * The model to validate.
     *
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * List of attributes and their associated rules.
     *
     * @var array
     */
    protected $rules = [
        'html_attributes.autocomplete' => 'string|in:on,off,name,email,username,new-password,current-password,organization-title,organization,street-address,address-level1,address-level2,address-level3,address-level4,country,country-name,postal-code,cc-name,cc-given-name,cc-additional-name,cc-family-name,cc-number,cc-exp,cc-exp-month,cc-exp-year,cc-csc,cc-type,transaction-currency,transaction-amount,language,bday,bday-day,bday-month,bday-year,sex,tel,tel-extension,email,impp,url,photo',
        'html_attributes.cols' => 'integer|min:0',
        'html_attributes.enctype' => 'string|in:application/x-www-form-urlencoded,multipart/form-data,text/plain',
        'html_attributes.height' => 'integer|min:0',
        'html_attributes.rows' => 'integer|min:0',
        'html_attributes.width' => 'integer|min:0',
    ];

    /**
     * Validate the model attributes
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Validation\Validator
     */
    public function validate(Model $model): \Illuminate\Validation\Validator
    {
        $this->model = $model;

        $attributes = $this->getAttributes();

        $rules = $this->getValidationRules($attributes);

        return Validator::make($attributes->all(), $rules->all());
    }

    /**
     * Get a formatted array of the model attributes.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getAttributes(): Collection
    {
        $attributes = collect($this->model->getAttributes());

        $attributes['html_attributes'] = $this->model->html_attributes ?? [];

        return $attributes;
    }

    /**
     * Get the validation rules of the attributes.
     *
     * @param  \Illuminate\Support\Collection $attributes
     * @return \Illuminate\Support\Collection
     */
    protected function getBasicRules(Collection $attributes): Collection
    {
        return collect($this->rules)->intersectByKeys(
            array_dot($attributes->all())
        );
    }

    /**
     * Get the validation rules of the attributes.
     *
     * @param  \Illuminate\Support\Collection $attributes
     * @return \Illuminate\Support\Collection
     */
    protected function getValidationRules(Collection $attributes): Collection
    {
        $rules = $this->getBasicRules($attributes);

        return $this->mergeAdditionalRules($rules);
    }

    /**
     * Append the additional rules to the default rules for each attribute.
     *
     * @param  \Illuminate\Support\Collection $rules
     * @return \Illuminate\Support\Collection
     */
    protected function mergeAdditionalRules(Collection $rules): Collection
    {
        $attributesRules = $this->model->attributesRules ?? [];

        foreach ($attributesRules as $attribute => $attributeRule) {
            $initialRules = $rules[$attribute] ?? '';
            $rules[$attribute] = sprintf('%s|%s', $initialRules, $attributeRule);
        }

        return $rules;
    }
}
