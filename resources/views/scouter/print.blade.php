<!DOCTYPE html>
    <html>
        <head>
            <title></title>
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
            <meta name="viewport" content="width= device-width, initial-scale=1.0, user-scalable=no, minimal-ui">
            <style>
                h3{
                    text-align: center;
                }
            </style>
        </head>
    <body>
        <h3>Nepal Scout</h3>
        <img src="{{ asset('img/logo.jpg') }}" alt="LOGO" style="width: 50px;">
        {{--<p><strong>District Scout Office</strong>, {{ $district->name }}</p>--}}
        {{--<p><strong>District Code</strong>, {{ $district->district_code }}</p>--}}
        {{--<h6><strong>Scarf</strong>, {{ $district->district_code }}</h6>--}}
        <p><strong>Border Colour</strong> {{ $organization->border_colour }}</p>
        <p><strong>Background Colour</strong>{{ $organization->background_colour }}</p>
        <p><strong>1. Organization Name</strong>{{ $organization->name }}</p>
        <p><strong>2. {{ $organization->type == 'school' ? 'Principal' : 'Chairman' }}</strong> {{ $organization->chairman_f_name }} {{ $organization->chairman_l_name }}</p>
        <p><strong>Mobile No.</strong>{{ $organization->mobile_no }}</p>
        <p><strong>Tel No.</strong>{{ $organization->tel_no }}</p>
        <p><strong>3. Address Line 1.</strong>{{ $organization->tel_no }}</p>
        <p><strong>Address Line 2.</strong>{{ $organization->address_line_2 or '-' }}</p>
        <p><strong>4. Email</strong>{{ $organization->email}}</p>
    </body>
</html>