<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $channel->channel_name }}'s Videos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: {{ $channel->color }};
        }

        .custom-back-button-wrapper .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            z-index: 9999;
        }

        .custom-back-button-wrapper .back-button svg {
            width: 32px;
            height: 32px;
            fill: #000000;
            transition: fill 0.3s ease;
        }

        .custom-back-button-wrapper .back-button:hover svg {
            fill: #f0f0f0;
        }

        .custom-back-button-wrapper .back-button:active svg {
            fill: #000000;
        }
    </style>
</head>
<body>
    <div class="custom-back-button-wrapper">
        <a href="/" class="back-button">
            <svg height="800px" width="800px" viewBox="0 0 26.676 26.676">
                <path d="M26.105,21.891c-0.229,0-0.439-0.131-0.529-0.346l0,0c-0.066-0.156-1.716-3.857-7.885-4.59
		            c-1.285-0.156-2.824-0.236-4.693-0.25v4.613c0,0.213-0.115,0.406-0.304,0.508c-0.188,0.098-0.413,0.084-0.588-0.033L0.254,13.815
		            C0.094,13.708,0,13.528,0,13.339c0-0.191,0.094-0.365,0.254-0.477l11.857-7.979c0.175-0.121,0.398-0.129,0.588-0.029
		            c0.19,0.102,0.303,0.295,0.303,0.502v4.293c2.578,0.336,13.674,2.33,13.674,11.674c0,0.271-0.191,0.508-0.459,0.562
		            C26.18,21.891,26.141,21.891,26.105,21.891z"/>
            </svg>
        </a>
    </div>

    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden py-6 sm:py-12">
        <div class="mx-auto">
            <div class="grid gap-6 justify-center {{ count($channel->videos) < 6 ? 'grid-cols-' . count($channel->videos) : 'grid-cols-6' }}">
                @if($channel->videos->count() < 1)
                    No Videos
                @else
                    @foreach ($channel->videos as $video)
                        <x-video-tile :video="$video" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>
