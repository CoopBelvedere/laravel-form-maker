<?php

return [

    /*
     |--------------------------------------------------------------------------
     |  Database Tables Name.
     |--------------------------------------------------------------------------
     |
     | The name of the different tables registered in your migrations.
     | You may customize them to fit your specific needs.
     */

    'database' => [
        'forms_table' => 'forms',
        'inputs_table' => 'inputs',
        'rankings_table' => 'rankings',
        'siblings_table' => 'siblings',
    ],

    /*
     |--------------------------------------------------------------------------
     | Form Nodes
     |--------------------------------------------------------------------------
     |
     | The different classes used by the form api.
     | You may swap any of the default implementations with your own.
     */

    'nodes' => [
        'inputs' => [
            'checkbox' => \Belvedere\FormMaker\Models\Inputs\Checkbox\Checkboxer::class,
            'color' => \Belvedere\FormMaker\Models\Inputs\Color\Colorer::class,
            'datalist' => \Belvedere\FormMaker\Models\Inputs\Datalist\Datalister::class,
            'date' => \Belvedere\FormMaker\Models\Inputs\Date\Dater::class,
            'email' => \Belvedere\FormMaker\Models\Inputs\Email\Emailer::class,
            'file' => \Belvedere\FormMaker\Models\Inputs\File\Filer::class,
            'image' => \Belvedere\FormMaker\Models\Inputs\Image\Imager::class,
            'month' => \Belvedere\FormMaker\Models\Inputs\Month\Monther::class,
            'number' => \Belvedere\FormMaker\Models\Inputs\Number\Number::class,
            'option' => \Belvedere\FormMaker\Models\Inputs\Option\Optioner::class,
            'password' => \Belvedere\FormMaker\Models\Inputs\Password\Passworder::class,
            'radio' => \Belvedere\FormMaker\Models\Inputs\Radio\Radioer::class,
            'range' => \Belvedere\FormMaker\Models\Inputs\Range\Ranger::class,
            'search' => \Belvedere\FormMaker\Models\Inputs\Search\Searcher::class,
            'select' => \Belvedere\FormMaker\Models\Inputs\Select\Selecter::class,
            'tel' => \Belvedere\FormMaker\Models\Inputs\Tel\Teler::class,
            'text' => \Belvedere\FormMaker\Models\Inputs\Text\Texter::class,
            'textarea' => \Belvedere\FormMaker\Models\Inputs\Textarea\Textareaer::class,
            'time' => \Belvedere\FormMaker\Models\Inputs\Time\Timer::class,
            'url' => \Belvedere\FormMaker\Models\Inputs\Url\Urler::class,
            'week' => \Belvedere\FormMaker\Models\Inputs\Week\Weeker::class,
        ],

        'siblings' => [
            'label' => \Belvedere\FormMaker\Models\Siblings\Label\Labeler::class,
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Ranking
     |--------------------------------------------------------------------------
     |
     | The ranking service used to order the form nodes.
     | You may swap the default implementation with your own.
     */

    'ranking' => \Belvedere\FormMaker\Models\Rankings\Ranker::class,

    /*
     |--------------------------------------------------------------------------
     | API Resources
     |--------------------------------------------------------------------------
     |
     | The different classes used to transform the models to JSON.
     | You may swap any of the default implementations with your own.
     */

    'resources' => [
        'input' => \Belvedere\FormMaker\Http\Resources\Input\InputResourcer::class,
        'sibling' => \Belvedere\FormMaker\Http\Resources\Sibling\SiblingResourcer::class,
    ],

    /*
     |--------------------------------------------------------------------------
     | Model Services
     |--------------------------------------------------------------------------
     |
     | The different services used by the models.
     | You may swap any of the default implementations with your own.
     */

    'services' => [
        'html_attributes' => \Belvedere\FormMaker\Models\HtmlAttributes\HtmlAttributer::class,
        'rules' => \Belvedere\FormMaker\Models\Rules\Ruler::class,
    ],
];