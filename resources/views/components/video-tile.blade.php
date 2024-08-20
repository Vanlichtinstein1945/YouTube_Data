<a href="{{ url('/video/' . $video->id) }}" class="group pb-40 relative overflow-hidden rounded-lg border border-black">
    <div class="group-hover:translate-y-0 transition-all duration-700 translate-y-full top-0 right-0 bottom-36 left-0 absolute z-10" style="background: linear-gradient(to bottom, transparent, {{ $video->channel->color }});"></div>
    <img src="{{ $video->thumbnail }}" class="transition-all group-hover:scale-125 duration-700 w-full h-60 object-cover" alt="Thumbnail">
    <div class="absolute z-10 bottom-0 left-0 w-full h-36 flex flex-col justify-center items-center" style="background: {{ $video->channel->color }}">
        <div class="z-20 absolute -top-5 w-full flex justify-center">
            <img src="{{ $video->channel->channel_pfp }}" style="width: 40px; height: 40px; border-radius: 50%;" alt="Profile Picture">
        </div>
        <div class="mt-8 text-sm">
            @if($video->averageRating() > 0)
                Average Rating: {{ number_format($video->averageRating(), 2) }} / 5 &#9733
            @else
                No Ratings
            @endif
        </div>
        <h2 class="font-bold text-center px-4">{{ $video->title }}</h2>
    </div>
</a>
