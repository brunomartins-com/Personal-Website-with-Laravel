<script src="{!! url('assets/js/validateContact.js') !!}"></script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <h4 class="modal-title font-size-28 green strong text-uppercase">Contact</h4>

    <br />
    {!! Form::open([
        'id' => 'formContact',
        'method'    => 'post',
        'class'     => 'formContact form-horizontal',
        'enctype'   => 'multipart/form-data',
        'url'       => route('contact')
        ])
    !!}
    <div class="form-group">
        <div class="col-xs-12">
            <div class="form-input">
                {!! Form::label('name', 'Name *') !!}
                {!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name', 'maxlength'=>50]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="form-input">
                {!! Form::label('email', 'Email *') !!}
                {!! Form::email('email', '', ['class'=>'form-control', 'id'=>'email', 'maxlength'=>50]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="form-input">
                {!! Form::label('phone', 'Phone/Mobile *') !!}
                {!! Form::text('phone', '', ['class'=>'form-control', 'id'=>'phone', 'maxlength'=>20]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="form-input">
                {!! Form::label('message', 'Message *') !!}
                {!! Form::textarea('message', '', ['class'=>'form-control', 'id'=>'message', 'rows'=>7]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="form-input">
                {!! Form::button('Send', ['class'=>'btn btn-success', 'type' => 'submit']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>