<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;

class Edit extends Component
{
    public $name;
    public $route;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $id)
    {
        $this->name = $name;
        $this->route = $route;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form.edit');
    }
}
