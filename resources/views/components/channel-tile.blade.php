<a href="{{ url('/channel/' . $channel->id) }}" class="group pb-36 relative overflow-hidden rounded-lg border border-black">
    <div class="group-hover:translate-y-0 transition-all duration-700 translate-y-full top-0 right-0 bottom-36 left-0 absolute z-10" style="background: linear-gradient(to bottom, transparent, {{ $channel->color }});"></div>
    <img src="{{ $channel->channel_pfp }}" class="transition-all group-hover:scale-125 duration-700 w-full h-60 object-cover" alt="Thumbnail">
    <div class="absolute z-10 bottom-0 left-0 w-full h-36 flex flex-col justify-center items-center" style="background: {{ $channel->color }}">
        <h2 class="font-bold text-center">{{ $channel->channel_name }}</h2>
        <div class="mt-2 text-sm">
            @php
                $averageRating = \App\Models\YouTubeUserVideoModel::WhereHas('video', function($query) use ($channel) {
                    $query->where('channel_id', $channel->id);
                })
                ->avg('user_rating');
            @endphp
            @if($averageRating > 0)
                Average User Rating: {{ number_format($averageRating, 2) }} / 5 &#9733
            @else
                No Ratings
            @endif
        </div>
    </div>
</a>
