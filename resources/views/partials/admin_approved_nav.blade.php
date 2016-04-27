<div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
        <li{!! Request::is('admin/view-approved-organization/*') ? ' class="active"': '' !!}>

            <a href="{{ url('admin/view-approved-organization', [$organization->id]) }}"><i class="fa fa-institution"></i> Organization Detail
            </a>

        </li>

        <li{!! Request::is('admin/approved-committee/*') ? ' class="active"': '' !!}>

            <a href="{{ url('admin/approved-committee', [$organization->id]) }}"><i class="fa fa-users"></i> Committe Member</a>

        </li>


        <li{!! Request::is('admin/approved-lead-scouter/*') ? ' class="active"': '' !!}>

            <a href="{{ url('admin/approved-lead-scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i>Lead Scouter Detail</a>

        </li>



        <li{!! Request::is('admin/scouter/*')  ? ' class="active"': '' !!}>

            <a href="{{ url('admin/approved-scouter', [$organization->id]) }}"><i class="fa fa-user-plus"></i> Assistant-Lead Scouter Detail</a>

        </li>

        <li{!! Request::is('admin/approved-teams/*')  ? ' class="active"': '' !!}>

            <a href="{{ url('admin/approved-teams', [$organization->id]) }}"><i class="fa fa-users"></i> Teams</a>

        </li>

        <li{!! Request::is('admin/approved-registration/*') ? ' class="active"': '' !!}>

            <a href="{{ url('admin/approved-registration', [$organization->id]) }}"><i class="fa fa-calculator"></i> Registration Cost Detail</a>

        </li>

    </ul>
</div><!-- /.box-body -->