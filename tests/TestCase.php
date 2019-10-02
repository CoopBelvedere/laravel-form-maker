<?php

namespace Belvedere\FormMaker\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('form-maker', [
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
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            "Belvedere\\FormMaker\\FormMakerServiceProvider",
            "Belvedere\\FormMaker\\Http\\Resources\\Nodes\\Inputs\\InputResourceServiceProvider",
            "Belvedere\\FormMaker\\Http\\Resources\\Nodes\\Inputs\\Datalist\\DatalistResourceServiceProvider",
            "Belvedere\\FormMaker\\Http\\Resources\\Nodes\\Siblings\\SiblingResourceServiceProvider",
            "Belvedere\\FormMaker\\Http\\Resources\\Nodes\\Siblings\\Label\\LabelResourceServiceProvider",
            "Belvedere\\FormMaker\\Models\\HtmlAttributes\\HtmlAttributeServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Checkbox\\CheckboxServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Color\\ColorServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Datalist\\DatalistServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Date\\DateServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Email\\EmailServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\File\\FileServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Image\\ImageServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Month\\MonthServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Number\\NumberServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Option\\OptionServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Password\\PasswordServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Radio\\RadioServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Range\\RangeServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Search\\SearchServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Select\\SelectServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Tel\\TelServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Text\\TextServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Textarea\\TextareaServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Time\\TimeServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Url\\UrlServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Inputs\\Week\\WeekServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Siblings\\Label\\LabelServiceProvider",
            "Belvedere\\FormMaker\\Models\\Nodes\\Siblings\\Paragraph\\ParagraphServiceProvider",
            "Belvedere\\FormMaker\\Models\\Rankings\\RankingServiceProvider",
            "Belvedere\\FormMaker\\Models\\Rules\\RuleServiceProvider",
            "Belvedere\\FormMaker\\Repositories\\NodeRepositoryServiceProvider"
        ];
    }

    /**
     * Set up the database.
     */
    protected function setUpDatabase()
    {
        include_once __DIR__.'/../database/migrations/create_form_maker_tables.php.stub';

        (new \CreateFormMakerTables())->up();
    }

}