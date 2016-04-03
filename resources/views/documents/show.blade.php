<!DOCTYPE html>
    <html>
        <head>
            <title>Document</title>
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
            <meta name="viewport" content="width= device-width, initial-scale=1.0, user-scalable=no, minimal-ui">
        </head>
    <body>
        <h1>{{ $document->title }}</h1>
        <p>{{ $document->body }}</p>

        <hr>

        <ul>
            @foreach( $document->adjustments as $user)
                <li> {{ $user->email }} on {{ $user->pivot->updated_at->diffForHumans() }}</li>
            @endforeach

        </ul>
    </body>
</html>