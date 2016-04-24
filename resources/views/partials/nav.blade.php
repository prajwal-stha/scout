<div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
        <li{!! Request::path() == '/' || Request::path() == 'scouter' ? ' class="active"': '' !!}><a href="{{ url('/') }}"><i class="fa fa-institution"></i> Organization Detail</a></li>
        <li{!! Request::path() == 'scarf' ? ' class="active"': '' !!}><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i> Scarf Detail</a></li>
        <li{!! Request::path() == 'committe' ? ' class="active"': '' !!}><a href="{{ url('/committe') }}"><i class="fa fa-users"></i> Committe Member</a></li>
        <li{!! Request::path() == 'scouter/lead-scouter' ? ' class="active"': '' !!}><a href="{{ url('scouter/lead-scouter') }}"><i class="fa fa-user-plus"></i>Lead Scouter Detail</a></li>
        <li{!! Request::path() == 'scouter/scouter' ? ' class="active"': '' !!}><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i> Assistant-Lead Scouter Detail</a></li>
        <li{!! Request::path() == 'team' || Request::is('scouter/team/*') ? ' class="active"': '' !!}><a href="{{ url('/team') }}"><i class="fa fa-users"></i> Teams</a></li>
        <li{!! Request::path() == 'registration' ? ' class="active"': '' !!}><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a></li>
    </ul>
</div><!-- /.box-body -->