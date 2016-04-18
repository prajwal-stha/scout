<div class="modal" id="districtModal" tabindex="-1" role="dialog" aria-labelledby="districtModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{ Form::model($member, ['url' => ['organizations/edit-member', $member['id']], 'method' => 'PATCH', 'class' => 'update-member-form']) }}

                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('f-name', 'First Name') }}
                        {{ Form::text('f_name', null, array('class' => 'form-control', 'id' => 'f-name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('m-name', 'Middle Name') }}
                        {{ Form::text('m_name', null, array('class' => 'form-control', 'id' => 'm-name')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('l-name', 'Last Name') }}
                        {{ Form::text('l_name', null, array('class' => 'form-control', 'id' => 'l-name')) }}
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-submit">Submit</button>
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>