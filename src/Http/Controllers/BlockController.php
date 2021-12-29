<?php

namespace GMJ\LaravelLivewire2Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelLivewire2Banner\Models\Block;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collections = Block::where("element_id", $element_id)->orderBy("display_order")->get();

        return view('LaravelLivewire2Banner::index', compact("element_id", "element", "collections"));
    }

    public function order($element_id)
    {
        $element = Element::find($element_id);
        $collections =  Block::where("element_id", $element_id)->orderBy("display_order")->get();
        return view("LaravelLivewire2Banner::order", compact("element_id", "element", "collections"));
    }

    public function order2($element_id)
    {
        foreach (request()->id as $key => $item) {
            $collection = Block::find($item);
            $num = $key + 1;
            $collection->display_order = $num;
            $collection->save();
        }
        $element = Element::find($element_id);
        Alert::success("Edit Element {$element->title} Banner Order success");
        return redirect()->route('LaravelLivewire2Banner.index', $element_id);
    }

    public function destroy($element_id, $id)
    {
        $collection = Block::findOrFail($id);
        $collection->delete();
        $element = Element::find($element_id);
        if ($collection->count() < 1) {
            $element->inactive();
        }
        Alert::success("Delete Element {$element->title} Banner success");
        return redirect()->route('LaravelLivewire2Banner.index', $element_id);
    }
}
