<div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        @if(isset($organization))
            <li{!! Request::path() == 'scouter/organization' || Request::path() == 'scouter' || Request::is('scouter/organization/*') ? ' class="active"': '' !!}><a href="{{ url('scouter/organization', [$organization->id]) }}"><i class="fa fa-institution"></i> <span>Unit Detail</span></a></li>
            <li{!! Request::path() == 'scarf' || Request::is('scouter/scarf/*')  || Request::is('scarf/*')? ' class="active"': '' !!}><a href="{{ url('/scarf', [$organization->id]) }}"><i class="fa fa-lemon-o"></i><span>Scarf Detail</span></a></li>
            <li{!! Request::path() == 'committe' || Request::is('scouter/committe/*')  || Request::is('committe/*') ? ' class="active"': '' !!}><a href="{{ url('/committe', [$organization->id]) }}"><i class="fa fa-users"></i><span> Committe Member</span></a></li>
            <li{!! Request::path() == 'scouter/lead-scouter' || Request::is('scouter/lead-scouter/*') ? ' class="active"': '' !!}><a href="{{ url('scouter/lead-scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i><span>Scout Master Detail</span></a></li>
            <li{!! Request::path() == 'scouter/scouter' || Request::is('scouter/scouter/*') ? ' class="active"': '' !!}><a href="{{ url('scouter/scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i><span> Assistant Scout Master Detail</span></a></li>
            <li{!! Request::path() == 'scouter/team' || Request::is('scouter/team/*') ? ' class="active"': '' !!}><a href="{{ url('scouter/team', [$organization->id]) }}"><i class="fa fa-users"></i> <span>Units</span></a></li>
            <li{!! Request::path() == 'registration' || Request::is('registration/*') || Request::is('scouter/registration/*')? ' class="active"': '' !!}><a href="{{ url('/registration', [$organization->id]) }}"><i class="fa fa-calculator"></i><span> Registration Cost Detail</span></a></li>
        @else
            <li{!! Request::path() == 'scouter/organization' || Request::path() == 'scouter' ? ' class="active"': '' !!}><a href="{{ url('scouter/organization') }}"><i class="fa fa-institution"></i> <span>Unit Detail</span></a></li>
            <li{!! Request::path() == 'scarf' ? ' class="active"': '' !!}><a href="{{ url('/scarf') }}"><i class="fa fa-lemon-o"></i><span>Scarf Detail</span></a></li>
            <li{!! Request::path() == 'committe' ? ' class="active"': '' !!}><a href="{{ url('/committe') }}"><i class="fa fa-users"></i><span> Committe Member</span></a></li>
            <li{!! Request::path() == 'scouter/lead-scouter' ? ' class="active"': '' !!}><a href="{{ url('scouter/lead-scouter') }}"><i class="fa fa-user-plus"></i><span>Scout Master Detail</span></a></li>
            <li{!! Request::path() == 'scouter/scouter' ? ' class="active"': '' !!}><a href="{{ url('scouter/scouter') }}"><i class="fa fa-user-plus"></i><span> Assistant Scout Master Detail</span></a></li>
            <li{!! Request::path() == 'team' || Request::is('scouter/team/*') ? ' class="active"': '' !!}><a href="{{ url('/team') }}"><i class="fa fa-users"></i> <span>Units</span></a></li>
            <li{!! Request::path() == 'registration' ? ' class="active"': '' !!}><a href="{{ url('/registration') }}"><i class="fa fa-calculator"></i><span> Registration Cost Detail</span></a></li>
        @endif
        @if(is_admin())
            <li><a href="{{ url('admin') }}"><i class="fa fa-fw fa-exchange"></i><span>Back to Admin Panel</span></a></li>
        @endif
    </ul>
</div><!-- /.box-body -->