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
        'form_nodes_table' => 'form_nodes',
        'rankings_table' => 'rankings',
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
            'checkbox' => \Belvedere\FormMaker\Models\Nodes\Inputs\Checkbox\Checkboxer::class,
            'color' => \Belvedere\FormMaker\Models\Nodes\Inputs\Color\Colorer::class,
            'datalist' => \Belvedere\FormMaker\Models\Nodes\Inputs\Datalist\Datalister::class,
            'date' => \Belvedere\FormMaker\Models\Nodes\Inputs\Date\Dater::class,
            'email' => \Belvedere\FormMaker\Models\Nodes\Inputs\Email\Emailer::class,
            'file' => \Belvedere\FormMaker\Models\Nodes\Inputs\File\Filer::class,
            'image' => \Belvedere\FormMaker\Models\Nodes\Inputs\Image\Imager::class,
            'month' => \Belvedere\FormMaker\Models\Nodes\Inputs\Month\Monther::class,
            'number' => \Belvedere\FormMaker\Models\Nodes\Inputs\Number\Number::class,
            'option' => \Belvedere\FormMaker\Models\Nodes\Inputs\Option\Optioner::class,
            'password' => \Belvedere\FormMaker\Models\Nodes\Inputs\Password\Passworder::class,
            'radio' => \Belvedere\FormMaker\Models\Nodes\Inputs\Radio\Radioer::class,
            'range' => \Belvedere\FormMaker\Models\Nodes\Inputs\Range\Ranger::class,
            'search' => \Belvedere\FormMaker\Models\Nodes\Inputs\Search\Searcher::class,
            'select' => \Belvedere\FormMaker\Models\Nodes\Inputs\Select\Selecter::class,
            'tel' => \Belvedere\FormMaker\Models\Nodes\Inputs\Tel\Teler::class,
            'text' => \Belvedere\FormMaker\Models\Nodes\Inputs\Text\Texter::class,
            'textarea' => \Belvedere\FormMaker\Models\Nodes\Inputs\Textarea\Textareaer::class,
            'time' => \Belvedere\FormMaker\Models\Nodes\Inputs\Time\Timer::class,
            'url' => \Belvedere\FormMaker\Models\Nodes\Inputs\Url\Urler::class,
            'week' => \Belvedere\FormMaker\Models\Nodes\Inputs\Week\Weeker::class,
        ],

        'siblings' => [
            'label' => \Belvedere\FormMaker\Models\Nodes\Siblings\Label\Labeler::class,
            'paragraph' => \Belvedere\FormMaker\Models\Nodes\Siblings\Paragraph\Paragrapher::class,
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
        'datalist' => \Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist\DatalistResourcer::class,
        'input' => \Belvedere\FormMaker\Http\Resources\Nodes\Inputs\InputResourcer::class,
        'label' => \Belvedere\FormMaker\Http\Resources\Nodes\Siblings\Label\LabelResourcer::class,
        'sibling' => \Belvedere\FormMaker\Http\Resources\Nodes\Siblings\SiblingResourcer::class,
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