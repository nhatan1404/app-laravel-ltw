<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $property;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $property)
    {
        $this->name = $name;
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form.select');
    }
}
