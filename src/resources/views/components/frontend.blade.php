<div class="laravel_livewire2_banner" id="laravel_livewire2_banner_{{$page_element_id}}">
    <div class="swiper" id="laravel_livewire2_banner_{{$page_element_id}}_swiper">
        <div class="swiper-wrapper">
            @foreach ($collections as $item)
                <div class="swiper-slide" style="height: auto">
                    <div class="h-full mx-auto">
                        <div class="relative flex flex-col h-full">
                            {!! $item->getTranslation("content", $locale) !!}
                        </div>
                    </div>
                </div>            
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

@push('css')
    <style>
        .laravel_livewire2_banner img{
            width: 100%;
        }
        .laravel_livewire2_banner .content-text-horizontal {
            opacity: 0;
            transform: translateY(60px);
            transition: all 0.6s;
            transition-delay: 1s;
        }
        .laravel_livewire2_banner .swiper-slide-active .content-text-horizontal {
            opacity: 1;
            transform: translateY(0)
        }
    </style>
@endpush

@push('js')
    <script>
        var swiper = new Swiper("#laravel_livewire2_banner_{{$page_element_id}}_swiper", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop:true,
            speed: 1000,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            }
        });
    </script>
@endpush