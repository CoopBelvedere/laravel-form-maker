<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Properties\{
    HasMultiple,
    HasRequired
};

class File extends Input
{
    use HasMultiple, HasRequired;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('file'));
    }

    // HTML PROPERTIES METHODS
    // ==============================================================

    /**
     * Indicates the types of files that the server accepts.
     *
     * @param null|string $accepted
     * @return self
     */
    public function htmlAccept(?string $accepted): self
    {
        $this->html_attributes = ['accept' => $accepted];

        return $this;
    }

    /**
     * Indicates that capture of media directly from the device's sensors
     * using a media capture mechanism is preferred, such as a webcam or microphone.
     *
     * @param string $capture
     * @return self
     */
    public function htmlCapture(?string $capture = 'capture'): self
    {
        $this->html_attributes = ['capture' => $capture];

        return $this;
    }
}
