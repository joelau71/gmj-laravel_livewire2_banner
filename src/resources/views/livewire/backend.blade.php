<div>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Banner", "link" => route("LaravelLivewire2Banner.index", $element->id)],
        ['name' => $mode]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div class="relative mt-4">
        <x-admin.atoms.required />

        <div class="mt-2" wire:ignore>
            <x-admin.atoms.row>
                <div class="flex">
                    <div class="w-40">
                        <x-admin.atoms.select id="vertical_align" class="appearance-none rounded-lg border-gray-300">
                            <option
                                value="top-10"
                                @if ($collection->vertical_align == "top-10") selected @endif
                            >
                                Top
                            </option>
                            <option
                                value="top-1/2 -translate-y-1/2"
                                @if ($collection->vertical_align == "top-1/2 -translate-y-1/2") selected @endif
                                >
                                Center
                            </option>
                            <option
                                value="bottom-10"
                                @if ($collection->vertical_align == "bottom-10") selected @endif
                            >
                                Bottom
                            </option>
                        </x-admin.atoms.select>
                    </div>
                    <div class="w-40 ml-4">
                        <x-admin.atoms.select id="column" class="appearance-none rounded-lg border-gray-300">
                            <option
                                value="lg:w-1/2"
                                @if ($collection->column == "lg:w-1/2") selected @endif
                            >
                                Left Side
                            </option>
                            <option
                                value="ml-auto lg:w-1/2"
                                @if ($collection->column == "ml-auto lg:w-1/2") selected @endif
                                >
                                Right Side
                            </option>
                            <option
                                value="mx-auto lg:w-1/2"
                                @if ($collection->column == "mx-auto lg:w-1/2") selected @endif
                                >
                                Center
                            </option>
                            <option
                                value=""
                                @if ($collection->column == "") selected @endif
                            >
                                Full
                            </option>
                        </x-admin.atoms.select>
                    </div>
                    <div class="ml-4 flex">
                        <input
                            type='text'
                            class='w-36 spectrum mt-2'
                            id="overlay_color_trigger"
                            value="{{ $collection->overlay_color }}"
                        />
                    </div>
                </div>
            </x-admin.atoms.row>
            
            <x-admin.atoms.row>
                <x-admin.atoms.label for="title" class="required">
                    Title
                </x-admin.atoms.label>
                <x-admin.atoms.text name="title" id="title" value="{{ $title }}" />
            </x-admin.atoms.row>
        </div>

        <div>
            @foreach (config('translatable.locales') as $locale)
                <x-admin.atoms.row>
                    <div>
                        <x-admin.atoms.label class="required mb-2">
                            Banner ({{ $locale }}) (website size: 1920 x 937) (laptop size: 1024 x 800)
                        </x-admin.atoms.label>
                        <div class="tinymce bg-white" data-lang="{{$locale}}" id="content_{{$locale}}">
                            {!! $collection->getTranslation("content", $locale) !!}
                        </div>
                    </div>
                </x-admin.atoms.row>
            @endforeach
        </div>
        
        <hr class="my-10">

        <div class="text-right">
            <x-admin.atoms.link href="{{ url()->previous() }}">
                Back
            </x-admin.atoms.link>
            <x-admin.atoms.button id="save">
                Save
            </x-admin.atoms.button>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function(){
            $("#vertical_align").on("change", function(e){
                const align = e.target.value;
                $(".content-text").removeClass("top-10 top-1/2 -translate-y-1/2 bottom-10").addClass(align);
            });
            $("#column").on("change", function(e){
                const column = e.target.value;
                $(".content-text-horizontal").removeClass("ml-auto mx-auto lg:w-1/2").addClass(column);
            });
            $("#overlay_color_trigger").on("change", function(e){
                const color = e.target.value;
                $(".overlay_color").css("backgroundColor", color);
                $(".overlay_color").attr("data-mce-style", `background-color: ${color}`);
            });

            $("#save").on("click", function(){
                const content = {};
                const title = $("#title").val();
                const vertical_aglin = $("#vertical_align").val();
                const column = $("#column").val();
                const overlay_color = $("#overlay_color_trigger").val();

                @foreach (config('translatable.locales') as $locale)
                    content["{{$locale}}"] = tinymce.get("content_{{$locale}}").getContent();
                @endforeach

                Livewire.emit("save", title, content, vertical_aglin, column, overlay_color);
            });
        });
    </script>
@endpush