<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DtActionButtons extends Component
{
    public $model;
    public $routePrefix;
    /**
     * Create a new component instance.
     */
    public function __construct($model, $routePrefix)
    {
        $this->model = $model;
        $this->routePrefix = $routePrefix;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dt-action-buttons');
    }
}