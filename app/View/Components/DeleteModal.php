<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    public $id;
    public $name;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct(int $id, string $name, string $route)
    {
        $this->id=$id;
        $this->name=$name;
        $this->route=$route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.components.delete-modal');
    }
}
