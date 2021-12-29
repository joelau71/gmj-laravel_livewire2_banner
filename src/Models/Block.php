<?php

namespace GMJ\LaravelLivewire2Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Faker\Factory;

class Block extends Model
{
    use HasTranslations;

    public $translatable = ['content'];
    protected $guarded = [];
    protected $table = "laravel_livewire2_banners";

    static public function setup($element_id)
    {
        $contents = [
            [
                "wb" => "https://images.unsplash.com/photo-1527206363095-ca2f054128b0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&h=937&q=80",
                "mb" => "https://images.unsplash.com/photo-1527206363095-ca2f054128b0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1024&h=700&q=80",
            ],
            [
                "wb" => "https://images.unsplash.com/photo-1515404929826-76fff9fef6fe?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&h=937&q=80",
                "mb" => "https://images.unsplash.com/photo-1515404929826-76fff9fef6fe?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1024&h=700&q=80",
            ],
            [
                "wb" => "https://images.unsplash.com/photo-1496046596374-a16aa8b8ae63?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&h=937&q=80",
                "mb" => "https://images.unsplash.com/photo-1496046596374-a16aa8b8ae63?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1024&h=700&q=80",
            ],
        ];
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $wb = $contents[$i]["wb"];
            $mb = $contents[$i]["mb"];

            foreach (config('translatable.locales') as $locale) {
                $text = $faker->text(60);
                $content[$locale] = self::sample($wb, $mb, $text);
            }

            $collection = new Block();
            $collection->element_id = $element_id;
            $collection->title = $faker->name;
            $collection->content = $content;
            $collection->vertical_align = "top-1/2 -translate-y-1/2";
            $collection->column = "lg:w-1/2";
            $collection->overlay_color = "rgba(0, 0, 0, 0.2)";
            $collection->display_order = $i + 1;
            $collection->save();
        }
    }

    static public function init($element_id)
    {
        $faker = Factory::create();
        foreach (config('translatable.locales') as $locale) {
            $content[$locale] = self::sample();
        }

        $collection = new Block();
        $collection->element_id = $element_id;
        $collection->title = $faker->name;
        $collection->content = $content;
        $collection->vertical_align = "top-1/2 -translate-y-1/2";
        $collection->column = "lg:w-1/2";
        $collection->overlay_color = "rgba(0, 0, 0, 0.2)";
        return $collection;
    }

    static public function sample($wb = null, $mb = null, $text = null)
    {
        if (!$wb || !$mb || !$text) {
            $wb = "https://images.unsplash.com/photo-1496692052106-d37cb66ab80c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&crop=entropy&w=1920&h=937&q=80";
            $mb = "https://images.unsplash.com/photo-1496692052106-d37cb66ab80c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&crop=entropy&w=1024&h=800&bottom=0&q=80";
            $text = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet totam itaque numquam! Sapiente necessitatibus illo magnam! Quas architecto maxime velit natus corrupti minima debitis quaerat! Tempora voluptas accusamus quasi culpa cupiditate aliquam repellendus ex quibusdam veniam, sequi natus odit magnam!";
        }

        return <<<HTML
            <div class="max-h-screen relative content overflow-hidden">
                <img src="{$wb}" class="lg:hidden relative left-1/2 transform -translate-x-1/2" style="min-width: 768px;" alt="">

                <img src="{$mb}" class="w-full hidden lg:block" alt="">

                <div class="absolute left-0 top-0 w-full h-full pointer-events-none overlay_color" style="background-color: rgba(0,0,0,0.2);"></div>
                
                <div class="content-text absolute w-full transform top-1/2 -translate-y-1/2">
                    <div class="text-white container mx-auto">
                        <div class="px-8 flex flex-col lg:w-1/2 content-text-horizontal">
                            <div class="main-element-title">Title</div>
                            <div>
                                {$text}
                            </div>
                            <div class="mt-2">
                                <a href="#" class="main-btn-bg-color main-btn-text-color rounded-md px-6 py-2 inline-block">More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
HTML;
    }
}
