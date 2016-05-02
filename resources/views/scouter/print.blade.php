<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<style media="all">
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
    }

    .container {
        width: 1170px;
        margin: auto;
        padding: 15px;
        font-family: 'Roboto', sans-serif;
    }

    @media all and (max-width: 1169px) {
        .container {
            width: 98%;
            padding: 30px 0;
        }
    }

    .heading {
        position: relative;
    }

    .left {
        width: 120px;
        position: absolute;
        left: 0;
        top: 0;
    }

    .middle {
        width: 100%;
        text-align: center;
        min-height: 130px;
    }

    .right {
        width: 260px;
        position: absolute;
        right: 0;
        top: 0;
    }

    .logo {
        max-width: 120px;
    }

    h1 {
        margin-top: 0;
        margin-bottom: 10px;
        line-height: 1.2;
        font-size: 35px;
    }

    h2, h3 {
        margin-bottom: 5px;
        margin-top: 0;
        font-size: 16px;
    }

    .left img {
        max-width: 100%;
    }

    .input {
        font-weight: 300;
    }

    .col-2 {
        float: left;
        width: 50%;
        margin-top: 20px;
    }

    .form-type {
        border: 1px solid #000;
        display: inline-block;
        text-align: right;

    }

    .clearfix {
        overflow: hidden;
    }

    .clearfix:after, .clearfix:before {
        content: '';
        display: table;
    }

    .clearfix:after {
        clear: both;
    }

    .form-info p {
        margin-bottom: 5px;
    }

    .form-type span {
        display: inline-block;
        padding: 6px 10px;
    }

    .form-type span:first-child {
        border-right: 1px solid #000;

    }

    .form-info {
        margin-top: 15px;;
    }

    .scaft {
        display: inline-block;
    }

    .box {
        border: 1px solid #000;
        display: inline-block;
        padding: 5px 10px;
    }

    .box div {
        margin-bottom: 5px;
        margin-top: 10px;
    }

    .box, .scaft-img {
        float: left;
    }

    .gender {
        text-align: center;
        font-weight: bold;
    }

    .form-title {
        text-align: center;
        display: block;
        margin-top: 10px;
        margin-bottom: 30px;
    }

    .form-title span {
        font-weight: bold;
        font-size: 35px;
        border: 1px solid #000;
        box-shadow: 2px 2px 2px #000;
        display: inline-block;
        padding: 4px 15px;
    }

    .form li {
        list-style: none;
    }

    .title {
        font-size: 18px;
        margin-top: 30px;
        padding-bottom: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 25px;;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 5px 10px;
        min-height: 45px;
    }

    .gender {
        font-size: 22px;
        margin-top: -60px;
        text-align: center;
        display: block;
    }

    .gender span {
        margin: auto;
    }

    ol, ul {
        padding-left: 0;

    }

    .member-list ul {
        margin-top: 15px;
        overflow: hidden;
        list-style: none;
    }

    .member-list li {
        padding: 7px 10px;
        border: 1px solid #000;
        width: 47%;
        float: left;
        display: inline-block;
    }

    .member-list {
        overflow: hidden;
    }

    .member-list > div {
        padding: 7px 10px;
        border: 1px solid #000;
        width: 47%;
        float: left;
        display: inline-block;
        margin-bottom: 15px;
    }

    .member-list > div:nth-child(2n) {
        float: right;
    }

    .footer {
        margin-top: 30px;
        border-top: 1px solid #000;
    }

    .footer ol {
        padding-left: 20px;
    }

    .approved-by {
        overflow: hidden;
    }

    .approved-by {
        margin-top: 65px;
    }

    .approved-by > div {
        float: left;
        width: 33.33%;
        text-align: center;
    }

    .approved-by span {
        display: block;
    }

    .pull-right {
        position: fixed;
        bottom: 30px;
        right: 20px;

    }

    .pull-right input[type="button"] {
        display: inline-block;
        padding: 10px 15px;
        background: #fff;
        border-radius: 2px;
        border: 1px solid #333;
    }


    @media screen and (max-width: 992px) {
        .heading {
            overflow: hidden;
        }

        .container {
            max-width: 98%;
            margin: auto;
            padding-left: 0;
            padding-right: 0;
        }

        .left {
            position: relative;
            margin: auto;
            float: left;
            margin-right: 15px;
        }

        .logo {
            width: 120px;
            float: left;

        }

        .member-list {
            margin-top: 20px;
        }

        .member-list > div {
            float: none;
            width: 90%;
        }

        .member-list > div:nth-child(2n) {
            float: none;
        }

        .middle {
            text-align: left;
            float: left;
            width: auto;

        }

        .gender {
            margin-top: 0;
        }

        .form-title, .form {
            max-width: 90%;
        }

        .right {
            width: 260px;
            position: relative;
            margin: auto;
            float: right;
        }

        table {
            max-width: 97%;
        }

        .table-wrap {
            overflow-x: scroll;
        }

    }

    @media screen and (max-width: 700px) {
        .approved-by, .footer {
            max-width: 90%;
        }

        .col-2 {
            float: none;
            width: 100%;
        }

        .approved-by > div {
            width: 100%;
            float: none;
            margin-bottom: 40px;
        }

        .gender {
            margin-top: 30px;
        }

        .gender span {
            font-size: 16px;
        }

        .right {
            float: left;
            margin-bottom: 30px;
        }

        .form-title span {
            font-size: 20px;
        }
    }


</style>
<style media="print">

        * {
            color: #000 !important;
        }

        .member-list > div {

            width: 45%;
        }

        body {
            font-family: Georgia, serif;
            background: none;
            font-size: 12px;
            margin: 0;
        }

        .title {
            font-size: 14px;
        }

        .form-title span {
            box-shadow: none;
        }
        .container {
            width: 100%;
            margin: 0;
            padding: 0;
            background: none;
        }

        h1 {
            font-size: 18px;
        }

        h2, h3 {
            font-size: 14px;
        }

        .form-title span {
            font-size: 20px;
        }

        .gender {
            margin-top: 10px;
        }

        .right {
            width: 200px;
        }

        table {
            max-width: 100%;
        }

        .pull-right input[type="button"] {
            display: none;
        }

</style>
<body>
<div class="container">
    <div class="heading">
        <div class="left"><img class="logo" src="{{ asset('img/logo.jpg') }}" alt="Nepal Scout"></div>
        <div class="middle">
            <h1>NEPAL SCOUT</h1>
            <h2>District Scout Office. <span>{{ $district->name }}</span></h2>
            <h2>District Code <span>{{ $district->district_code }}</span></h2>
        </div>
        <div class="right">
            <div class="form-type clearfix">
                <span>Registration</span>
                <span>Renew</span>
            </div>
            <div class="form-info clearfix">
                <p>Fiscal year <span>...............................</span></p>
                <p>Registration No.<span>{{ $organization->registration_no }}</span></p>
                <p>Code No. <span>...............................</span></p>
                <p>Start date <span>{{ $organization->registration_date }}</span></p>
            </div>
        </div>
    </div>
    <div class="heading-bottom clearfix">
        <div class="scaft">
            <div class="title">Scarf Color</div>
            <div class="box clearfix">
                <div class="text">
                    <div>
                        Border : <span>{{ $organization->border_colour }}</span>
                    </div>
                    <div>
                        Background : <span>{{ $organization->background_colour }}</span>
                    </div>
                </div>
                <!--    <div class="scaft-img">
                        <img src="" alt="">
                    </div>-->
            </div>
        </div>
        <div class="gender">
            <span> Male/ Female Section</span>
        </div>
        <div class="form-title"><span>Registration / Renew Form</span></div>
    </div>
    <div class="form">
        <ol>
            <li><span class="title">School/Institute : </span>
                <span class="input">{{ $organization->name }}</span>
            </li>
            <li class="clearfix">

                <div class="col-2">
                    <span class="title">Principal/Chairman Name : </span>
                    <span class="input">{{ $organization->chairman_f_name }} {{ $organization->chairman_l_name }}</span>
                </div>
                <div class="col-2">
                    <span class="title">Mobile No. : </span>
                    <span class="input">{{ $organization->chairman_mobile_no }}</span>
                </div>

            </li>
            <li class="clearfix">
                <div class="col-2">
                    <span class="title">Address : </span>
                    <span class="input">{{ $organization->address_line_1 }} {{ $organization->address_line_2 }}</span>
                </div>
                <div class="col-2">
                    <span class="title">Phone NO. : </span>
                    <span class="input">{{ $organization->tel_no }}</span>
                </div>

            </li>
            <li class="clearfix">
                <div class="col-2">
                    <span class="title">Email (School/Institute)  </span>
                    <span class="input">{{ $organization->email}}</span>
                </div>
                <div class="col-2">
                    <span class="title">Email (Scouter)</span>
                    <span class="input">{{ $leadScouter->email or '-' }}</span>
                </div>

            </li>
            <li>
                <div class="title">Committee Member</div>
                <div class="member-list clearfix">
                    <div>
                        <div>Chairman: <span class="input">{{ $organization->chairman_f_name }} {{ $organization->chairman_l_name }}</span></div>
                    </div>
                    @if($member)
                        @foreach($member as $value)
                            <div>
                                <div>Member: <span class="input">{{ $value->f_name }} {{ $value->m_name or '' }} {{ ' ' .$value->l_name }}</span></div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </li>
            <li>
                <div class="title">Scouter Detail</div>
                <div class="table-wrap">
                    <table>
                        <tr>
                            <th></th>
                            <th>Full Name</th>
                            <th>Permission letter / Date</th>
                            <th>B.T.C/ P.T.C. / Date</th>
                            <th>Advance / Date</th>
                            <th>A.L.T / Date</th>
                            <th>LT / Date</th>
                        </tr>
                        @if($leadScouter)
                            <tr>
                                <th>Lead Scouter</th>
                                <td>{{ $leadScouter->name }}</td>
                                <td>{{ $leadScouter->permission or '-' }}  {{ $leadScouter->permission_date or '-' }}</td>
                                <td>{{ $leadScouter->btc_no or '-' }}  {{ $leadScouter->btc_date or '-' }}</td>
                                <td>{{ $leadScouter->advance_no or '-' }}  {{ $leadScouter->advance_date or '-' }}</td>
                                <td>{{ $leadScouter->alt_no or '-' }}  {{ $leadScouter->alt_date or '-' }}</td>
                                <td>{{ $leadScouter->lt_no or '-' }}  {{ $leadScouter->lt_date or '-' }}</td>
                            </tr>
                        @endif
                        @if($scouter)
                            <tr>
                                <th>Assistant-Lead Scouter</th>
                                <td>{{ $scouter->name }}</td>
                                <td>{{ $scouter->permission or '-' }}  {{ $scouter->permission_date or '-' }}</td>
                                <td>{{ $scouter->btc_no or '-' }}  {{ $scouter->btc_date or '-' }}</td>
                                <td>{{ $scouter->advance_no or '-' }}  {{ $scouter->advance_date or '-' }}</td>
                                <td>{{ $scouter->alt_no or '-' }}  {{ $scouter->alt_date or '-' }}</td>
                                <td>{{ $scouter->lt_no or '-' }}  {{ $scouter->lt_date or '-' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </li>

            @if(count($team_member) && count($team) > 0)

                @foreach($team as $value)
                    <?php $i = 1; ?>

                    <li>
                        <div class="title">{{ $value->name }} </div>
                        <div class="table-wrap">
                            <table>
                                <tr>
                                    <th>SN.</th>
                                    <th>Position</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Entry Date</th>
                                    <th>Current Position</th>
                                    <th>Passed Date</th>
                                    <th>Remark</th>
                                </tr>
                                <?php

                                foreach($team_member as $member){
                                    if($value->name !== $member->team_name){
                                        continue;
                                    }  ?>

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $member->position }} </td>
                                        <td>{{ $member->f_name }} {{ $member->m_name }} {{ $member->l_name  }}</td>
                                        <td>{{ $member->dob }}</td>
                                        <td>{{ $member->entry_date }}</td>
                                        <td></td>
                                        <td>{{ $member->passed_date }}</td>
                                        <td>{{ $member->note }}</td>
                                    </tr>

                                <?php
                                $i++; } ?>
                            </table>
                        </div>
                    </li>
                @endforeach

            @endif
            <li>
                <div class="title">Cost</div>
                <div class="table-wrap">
                    <table>
                        <tr>
                            <th></th>
                            <th>Total Member</th>
                            <th>Rate</th>
                            <th>Total</th>

                        </tr>
                        <tr>
                            <th>Unit Registration / Renew</th>
                            <td>-</td>
                            <td>{{ 'Rs. '. $rates->registration_rate }}</td>
                            <td>{{ 'Rs. '. $rates->registration_rate }}</td>
                        </tr>
                        <tr>
                            <th>Scouter (M / F)</th>
                            <td>{{ $scouter_no }}</td>
                            <td>{{ 'Rs. '. $rates->scouter_rate }}</td>
                            <td>{{ 'Rs. ' . ($scouter_no * $rates->scouter_rate) }}</td>
                        </tr>
                        <tr>

                            <th>Scout</th>
                            <td>{{ $scout_no }}</td>
                            <td>{{ 'Rs. '. $rates->team_rate }}</td>
                            <td>{{ 'Rs. '. ($scout_no * $rates->team_rate) }}</td>
                        </tr>

                        <tr>

                            <th>Organization Commitee Member</th>
                            <td>{{ $member_no }}</td>
                            <td>{{ 'Rs. ' . $rates->committee_members_rate }}</td>
                            <td>{{ 'Rs. ' . ($member_no * $rates->committee_members_rate) }}</td>
                        </tr>
                        <tr>

                            <th>Disaster Management Trust</th>
                            <td>{{ $total }}</td>
                            <td>{{ 'Rs. ' . $rates->disaster_mgmt_trust_rate }}</td>
                            <td>{{ 'Rs. ' . ($total * $rates->disaster_mgmt_trust_rate) }}</td>
                    </table>
                </div>
            </li>
        </ol>
    </div>

    <div class="approved-by">
        <div>
            <span>............................................</span>
            District Committee
        </div>
        <div>
            <span>............................................</span>
            District coordinator
        </div>
        <div>
            <span>............................................</span>
            District Committee
        </div>
    </div>

    <div class="footer">
        @if($terms)
            <ol>
                @foreach($terms as $value)
                    <li>{{ $value->terms }}</li>
                @endforeach
            </ol>
        @endif
    </div>
    <div class="pull-right">
        <form>
            <input type="button" onclick="window.print()" value="PRINT"/>
        </form>
    </div>

</div>
</body>
</html>