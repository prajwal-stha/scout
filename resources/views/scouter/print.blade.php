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
        <p><strong>District Scout Office</strong>, {{ $district->name }}</p>
        <p><strong>District Code</strong>, {{ $district->district_code }}</p>
        <h4><strong>Scarf</strong></h4>
        <p><strong>Border Colour</strong> {{ $organization->border_colour }}</p>
        <p><strong>Background Colour</strong>{{ $organization->background_colour }}</p>
        <p><strong>1. Organization Name</strong>{{ $organization->name }}</p>
        <p><strong>2. {{ $organization->type == 'school' ? 'Principal' : 'Chairman' }}</strong> {{ $organization->chairman_f_name }} {{ $organization->chairman_l_name }}</p>
        <p><strong>Mobile No.</strong>{{ $organization->mobile_no }}</p>
        <p><strong>Tel No.</strong>{{ $organization->tel_no }}</p>
        <p><strong>3. Address Line 1.</strong>{{ $organization->tel_no }}</p>
        <p><strong>Address Line 2.</strong>{{ $organization->address_line_2 or '-' }}</p>
        <p><strong>4. Email</strong>{{ $organization->email}}</p>
        <h4><strong>Organization Committe Member Detail</strong></h4>
        <table>
            <tbody>
                <tr>
                    <td>Chairman: {{ $organization->chairman_f_name }} {{ $organization->chairman_l_name }}</td>
                </tr>

                @if($member)
                    @foreach($member as $value)
                        <tr><td> Member: {{ $value->f_name }} {{ $value->m_name or '' }} {{ ' ' .$value->l_name }}</td></tr>
                    @endforeach
                @endif

            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Full Name</th>
                    <th>Permission Letter No./ Date</th>
                    <th>B.T.C / P.T.C No. / Date</th>
                    <th>Advance Certificate No. / Date</th>
                    <th>ALT No. / Date</th>
                    <th>LT No. / Date</th>
                </tr>
            </thead>
            <tbody>
                @if($leadScouter)
                    <tr>
                        <td>Lead Scouter</td>
                        <td>{{ $leadScouter->name }}</td>
                        <td>{{ $leadScouter->permission or '-' }} / {{ $leadScouter->permission_date or '-' }}</td>
                        <td>{{ $leadScouter->btc_no or '-' }} / {{ $leadScouter->btc_date or '-' }}</td>
                        <td>{{ $leadScouter->advance_no or '-' }} / {{ $leadScouter->advance_date or '-' }}</td>
                        <td>{{ $leadScouter->alt_no or '-' }} / {{ $leadScouter->alt_date or '-' }}</td>
                        <td>{{ $leadScouter->lt_no or '-' }} / {{ $leadScouter->lt_date or '-' }}</td>
                    </tr>
                @endif

                @if($scouter)
                    <tr>
                        <td>Assistant-Lead Scouter</td>
                        <td>{{ $scouter->name }}</td>
                        <td>{{ $scouter->permission or '-' }} / {{ $scouter->permission_date or '-' }}</td>
                        <td>{{ $scouter->btc_no or '-' }} / {{ $scouter->btc_date or '-' }}</td>
                        <td>{{ $scouter->advance_no or '-' }} / {{ $scouter->advance_date or '-' }}</td>
                        <td>{{ $scouter->alt_no or '-' }} / {{ $scouter->alt_date or '-' }}</td>
                        <td>{{ $scouter->lt_no or '-' }} / {{ $scouter->lt_date or '-' }}</td>
                    </tr>
                @endif

            </tbody>
        </table>

        @if($team)
            @foreach($team as $value)
                <table>
                    <caption>{{ $value->name }}</caption>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Position</th>
                            <th>DOB</th>
                            <th>Entry Date</th>
                            <th></th>
                            <th>Passed Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        @endif
    </body>
</html>