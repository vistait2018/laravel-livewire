<?php

namespace App\View\Components\utils;

use Carbon\Carbon;
use Illuminate\View\Component;

class AlertComponent extends Component
{

    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

   
    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type = null )
    {
        $this->type = $type;

    }


    public function setTypeClass()
    {
        if ($this->type === "error") {
            return 'alert alert-danger ';
        } elseif ($this->type === "warning") {
            return 'alert alert-info ';
        }
        return 'alert alert-success ';
    }



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.alert-component');
    }
}
