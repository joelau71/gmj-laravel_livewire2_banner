<?php

namespace GMJ\LaravelLivewire2Banner\Http\Livewire;

use App\Models\Element;
use Livewire\Component;
use Faker\Factory;
use Alert;
use GMJ\LaravelLivewire2Banner\Models\Block;

class Backend extends Component
{

    public $collection;
    public $element_id;
    public $element;
    public $mode;
    public $title;
    public $block_id;

    protected $listeners = ["save"];

    public function mount($element_id)
    {
        $this->element_id = $element_id;
        $this->element = Element::findOrFail($this->element_id);
        if (request()->id) {
            $this->mode = "edit";
            $this->collection = Block::findOrFail(request()->id);
            $this->block_id = $this->collection->id;
            $this->title = $this->collection->title;
        } else {
            $faker = Factory::create();
            $this->mode = "create";
            $this->title = $faker->name;
            $this->collection = Block::init($element_id);
        }
    }

    public function save($title, $content, $vertical_align, $column, $overlay_color)
    {
        if ($this->mode == "create") {
            $this->store($title, $content, $vertical_align, $column, $overlay_color);
        } else {
            $this->update($title, $content, $vertical_align, $column, $overlay_color);
        }
    }

    public function store($title, $content, $vertical_align, $column, $overlay_color)
    {

        $display_order = Block::where("element_id", $this->element_id)->max("display_order");
        $display_order++;

        $collection = new Block();
        $collection->element_id = $this->element_id;
        $collection->title = $title;
        $collection->content = $content;
        $collection->vertical_align = $vertical_align;
        $collection->column = $column;
        $collection->overlay_color = $overlay_color;
        $collection->display_order = $display_order;
        $collection->save();

        $this->element->is_active = 1;
        $this->element->save();

        Alert::success("Add Banner Success");
        return redirect()->route("LaravelLivewire2Banner.create", $this->element_id);
    }

    public function update($title, $content, $vertical_align, $column, $overlay_color)
    {

        $collection = Block::findOrFail($this->block_id);
        $collection->element_id = $this->element_id;
        $collection->title = $title;
        $collection->content = $content;
        $collection->vertical_align = $vertical_align;
        $collection->column = $column;
        $collection->overlay_color = $overlay_color;
        $collection->save();

        Alert::success("Edit Banner Success");
        return redirect()->route("LaravelLivewire2Banner.index", $this->element_id);
    }

    public function render()
    {
        return view('LaravelLivewire2Banner::livewire.backend');
    }
}
