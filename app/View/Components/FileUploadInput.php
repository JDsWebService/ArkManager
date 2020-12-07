<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileUploadInput extends Component
{
    /**
     * Label to be used in the component
     *
     * @var string
     */
    public $label;

    /**
     * Name of the input field in the component
     *
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param string $label Label text
     * @param string $name Input field name
     */
    public function __construct(string $label = "File Upload", string $name = "fileUpload")
    {
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.file-upload-input');
    }
}
