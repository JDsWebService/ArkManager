<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminTinyMCEEditor extends Component
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
     * Margin at the top
     *
     * @var bool
     */
    public $margin;

    /**
     * Model Value if set
     *
     * @var bool|string
     */
    public $model;

    /**
     * Create a new component instance.
     *
     * @param string $id CSS ID Attribute
     * @param bool $margin Margin at top
     * @param string $placeholder Placeholder Text
     * @param string $label Label Text above Textarea
     * @param bool|string $model
     */
    public function __construct(string $id, bool $margin = false, string $placeholder = "Write Your Next Great Story", string $label = "Description", $model = false)
    {
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->margin = $margin;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin-tiny-m-c-e-editor');
    }
}
