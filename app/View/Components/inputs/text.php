<?php

namespace App\View\Components\inputs;

use Illuminate\View\Component;

class text extends Component
{

    public $for;
    public $label;
    public $value;
    // public $placeholder;
    public $id;
    public $name;
    public $icon;
    public $formNote;
    public $required;
    public $class;
    public $readonly;
    
    

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $for = '',
        $label = '',
        $value = '',
        // $placeholder = '',
        $id = '',
        $name = '',
        $icon = '',
        $formNote = '',
        $required = 'false',
        $class = '',
        $readonly = ''
       
    ) {
        $this->for = $for;
        $this->label = $label;
        $this->value = $value;
        // $this->placeholder = $placeholder;
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->formNote = $formNote;
        $this->required = $required;
        $this->class = $class;
        $this->readonly = $readonly;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.inputs.text');
    }
}
