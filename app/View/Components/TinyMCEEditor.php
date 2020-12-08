<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinyMCEEditor extends Component
{
    /**
     * Label to be used in the component
     *
     * @var string
     */
    public $placeholder;

    /**
     * CSS ID attribute of the Text Area
     *
     * @var string
     */
    public $id;

    /**
     * Label text above the textarea
     *
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @param string $placeholder Placeholder Text
     * @param string $label Label Text above Textarea
     * @param string $id CSS ID Attribute
     */
    public function __construct(string $id, string $placeholder = "Write Your Next Great Story", string $label = "Description")
    {
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tiny-m-c-e-editor');
    }
}
