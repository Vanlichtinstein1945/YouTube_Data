<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Channels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #1a1a2e;
        }
    </style>
</head>
<body>
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden py-6 sm:py-12">
        <div class="mx-auto">
            <div class="grid gap-6 justify-center {{ count($channels) < 6 ? 'grid-cols-' . count($channels) : 'grid-cols-6' }}">
                @foreach ($channels as $channel)
                    <x-channel-tile :channel="$channel" />
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
