<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{
    public $posts;

    //LE PASAMOS EL MISMO NOMBRE DE LA VARIABLE posts que esta en el componente
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
