<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $property;
    public $placeholder;
    public $value;
    public $rows;
    public $columns;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $property, $placeholder, $value, $rows=null, $columns=null)
    {
        $this->name = $name;
        $this->property = $property;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->rows = $rows;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form.textarea');
    }
}
