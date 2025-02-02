<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public $label;
    public $type;
    public $name;
    public $value;
    public $id;
    public $required;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $label,
        $name,
        $type = 'text',
        $value = null,
        $id = null,
        $required = false
    ) {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value ?? old($name, '');
        $this->id = $id ?? $name;
        $this->required = $required ? 'required' : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-group');
    }
}
