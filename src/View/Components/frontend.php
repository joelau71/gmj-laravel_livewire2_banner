<?php

namespace GMJ\LaravelLivewire2Banner\View\Components;

use GMJ\LaravelLivewire2Banner\Models\Block;
use Illuminate\View\Component;

class Frontend extends Component
{
    public $element_id;
    public $page_element_id;
    public $collections;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collections = Block::where("element_id", $elementId)->orderBy("display_order")->get();
    }

    public function render()
    {
        return view("LaravelLivewire2Banner::components.frontend");
    }
}
