<div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">

        <li{!! Request::is('admin/view-organization/*') ? ' class="active"': '' !!}>
            <a href="{{ url('admin/view-organization', [$organization->id]) }}"><i class="fa fa-institution"></i> Organization Detail
            </a>
        </li>

        <li{!! Request::is('admin/committee/*') ? ' class="active"': '' !!}>
            <a href="{{ url('admin/committee', [$organization->id]) }}"><i class="fa fa-users"></i> Committe Member</a>
        </li>


        <li{!! Request::is('admin/lead-scouter/*') ? ' class="active"': '' !!}>
            <a href="{{ url('admin/lead-scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i>Lead Scouter Detail</a>
        </li>



        <li{!! Request::is('admin/scouter/*')  ? ' class="active"': '' !!}>
            <a href="{{ url('admin/scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i> Assistant-Lead Scouter Detail</a>
        </li>

        <li{!! Request::is('admin/teams/*') ? ' class="active"': '' !!}>
            <a href="{{ url('admin/teams', [$organization->id]) }}"><i class="fa fa-users"></i> Teams</a>
        </li>

        <li{!! Request::is('admin/registration/*') ? ' class="active"': '' !!}>
            <a href="{{ url('admin/registration', [$organization->id]) }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a>
        </li>

    </ul>
</div><!-- /.box-body -->