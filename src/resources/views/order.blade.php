<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Banner", "link" => route('LaravelLivewire2Banner.index', $element_id)],
        ['name' => "Order"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div class="text-right mb-6">
        <x-admin.atoms.button form="myForm">
            Save
        </x-admin.atoms.button>
        <x-admin.atoms.link href="{{ url()->previous() }}">
            Back
        </x-admin.atoms.link>
    </div>

    <form
        id="myForm"
        method="POST"
        action="{{ route('LaravelLivewire2Banner.order2', $element_id) }}"
    >
        @csrf
        <div id="menu-list">
            @foreach ($collections as $item)
                <div class="py-3 px-6 bg-black text-white rounded-md w-full mt-4 cursor-move">
                    {{ $item->title }}
                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                </div>
            @endforeach
        </div>
    </form>

    @push("js")
        <script>
            $(function() {
                $("#menu-list").sortable();
            });
        </script>
    @endpush
</x-admin.layout.app>