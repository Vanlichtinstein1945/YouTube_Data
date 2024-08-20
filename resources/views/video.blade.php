<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $video->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: {{ $video->channel->color }};
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .video-container {
            background-color: #000000;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 85vw;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #FFFFFF;
            margin-bottom: 15px;
        }

        .responsive-iframe {
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .responsive-iframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
            border: none;
        }

        p {
            font-size: 16px;
            color: #FFFFFF;
            margin-top: 15px;
        }

        .rating-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .rating-stars {
            display: flex;
            gap: 5px;
            direction: rtl;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .rating-stars input:checked ~ label,
        .rating-stars input:checked + label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ffcc00;
        }

        .average-rating {
            font-size: 16px;
            color: #FFFFFF;
            margin-bottom: 10px;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .back-button svg {
            width: 32px;
            height: 32px;
            fill: #000000;
            transition: fill 0.3s ease;
        }

        .back-button:hover svg {
            fill: #f0f0f0;
        }

        .back-button:active svg {
            fill: #000000;
        }
    </style>
</head>
<body>
    <a href="/channel/{{ $video->channel->id }}" class="back-button">
        <svg height="800px" width="800px" viewBox="0 0 26.676 26.676">
            <path d="M26.105,21.891c-0.229,0-0.439-0.131-0.529-0.346l0,0c-0.066-0.156-1.716-3.857-7.885-4.59
		        c-1.285-0.156-2.824-0.236-4.693-0.25v4.613c0,0.213-0.115,0.406-0.304,0.508c-0.188,0.098-0.413,0.084-0.588-0.033L0.254,13.815
		        C0.094,13.708,0,13.528,0,13.339c0-0.191,0.094-0.365,0.254-0.477l11.857-7.979c0.175-0.121,0.398-0.129,0.588-0.029
		        c0.19,0.102,0.303,0.295,0.303,0.502v4.293c2.578,0.336,13.674,2.33,13.674,11.674c0,0.271-0.191,0.508-0.459,0.562
		        C26.18,21.891,26.141,21.891,26.105,21.891z"/>
        </svg>
    </a>

    <div class="video-container">
        <div class="responsive-iframe">
            <iframe src="https://www.youtube.com/embed/{{ $video->video_id }}"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <h1>{{ $video->title }}</h1>
        <p>{{ $video->channel->channel_name }}</p>

        <div class="rating-container">
            <div class="average-rating">
                @if($video->averageRating() > 0)
                    Average Rating: {{ number_format($averageRating, 2) }} / 5
                @else
                    No Ratings
                @endif
            </div>
            <div class="rating-stars">
                <form id="ratingForm" action='/video/{{ $video->id }}/rate' method="POST">
                    @csrf
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="user_rating" value="{{ $i }}"
                            @auth
                                {{ $userRating == $i ? 'checked' : '' }}
                            @endauth
                        >
                        <label for="star{{ $i }}"
                            @guest
                                onclick="window.location.href='/login'; return false;"
                            @endguest
                        >&#9733;</label>
                    @endfor
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.rating-stars input').forEach((star) => {
            star.addEventListener('change', function() {
                const form = document.getElementById('ratingForm');
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                if (data.averageRating !== undefined) {
                    document.querySelector('.average-rating').textContent = `Average Rating: ${Number.parseFloat(data.averageRating).toFixed(2)} / 5`;
                }
            })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
