<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Table extends Component
{
    public $name;
    public $columns;
    public $create;
    public $value;
    public $isShowCreate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $columns, $create, $value = [], $isShowCreate = true)
    {
        $this->name = $name;
        $this->columns = $columns;
        $this->create = $create;
        $this->value = $value;
        $this->isShowCreate = $isShowCreate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.table');
    }
}
