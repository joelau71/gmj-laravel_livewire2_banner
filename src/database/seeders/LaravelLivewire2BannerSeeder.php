<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use GMJ\LaravelLivewire2Banner\Models\Block;
use Illuminate\Database\Seeder;

class LaravelLivewire2BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelLivewire2Banner")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Livewire2 Banner ",
                "component" => "LaravelLivewire2Banner",
            ]
        );
        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-livewire2-banner-sample",
            "is_active" => 1
        ]);

        Block::setup($element->id);
    }
}
