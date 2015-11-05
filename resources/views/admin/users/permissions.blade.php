@extends('admin.sidebar-template')

@section('title', 'User Permissions | ')

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Users <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('users') }}" class="text-success" title="Users">Users</a></li>
                    <li>{{ $user->name }}</li>
                    <li>Permissions</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-darker text-white">
                <ul class="block-options">
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('users') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Permissions - {{ $user->name }}</h3>
            </div>
            <div class="block-content">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- .block-content -->
                <div class="block-content block-content-full">
                    {!! Form::open([
                        'id' => 'users',
                        'method' => 'post',
                        'class' => 'form-horizontal push-20-t',
                        'enctype' => 'multipart/form-data',
                        'url' => route('usersPermissionsPost')
                        ])
                    !!}
                    {!! Form::hidden('userId', $user->id) !!}
                    <!-- Intro Category -->
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead>
                        <tr>
                            <th>Página</th>
                            <th class="text-center" style="width: 100px;">
                                <h5>Access</h5>
                                <label class="css-input switch switch-sm switch-success">
                                    <input id="accessAll" type="checkbox" value="1" />
                                    <span></span>
                                </label>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <h5>Add</h5>
                                <label class="css-input switch switch-sm switch-success">
                                    <input id="addAll" type="checkbox" value="1" />
                                    <span></span>
                                </label>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <h5>Edit</h5>
                                <label class="css-input switch switch-sm switch-success">
                                    <input id="editAll" type="checkbox" value="1" />
                                    <span></span>
                                </label>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <h5>Delete</h5>
                                <label class="css-input switch switch-sm switch-success">
                                    <input id="deleteAll" type="checkbox" value="1" />
                                    <span></span>
                                </label>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pagesAdmin as $page)
                            <tr>
                                <td>
                                    <h4 class="h5 font-w600 push-5">{{ $page->title }}</h4>
                                </td>
                                <td class="text-center">
                                    <label class="css-input switch switch-success">
                                        <input class="access" name="{{ $page->pagesAdminId }}@access" id="access-{{ $page->pagesAdminId }}" data-id="{{ $page->pagesAdminId }}" type="checkbox" value="1" @if($page->permission->access == 1) checked @endif />
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="css-input switch switch-success">
                                        <input class="add" name="{{ $page->pagesAdminId }}@add" id="add-{{ $page->pagesAdminId }}" type="checkbox" value="1" @if($page->permission->access == 1 and $page->permission->add) checked @endif @if($page->permission->access == 0) disabled @endif />
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="css-input switch switch-success">
                                        <input class="edit" name="{{ $page->pagesAdminId }}@edit" id="edit-{{ $page->pagesAdminId }}" type="checkbox" value="1" @if($page->permission->access == 1 and $page->permission->edit) checked @endif @if($page->permission->access == 0) disabled @endif />
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="css-input switch switch-success">
                                        <input class="delete" name="{{ $page->pagesAdminId }}@delete" id="delete-{{ $page->pagesAdminId }}" type="checkbox" value="1" @if($page->permission->access == 1 and $page->permission->delete) checked @endif @if($page->permission->access == 0) disabled @endif />
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-xs-12 push-20-t">
                            {!! Form::submit('Save', ['class'=>'btn btn-success pull-right push-20-l']) !!}
                            {!! Form::button('Cancel', ['class'=>'btn btn-inverse pull-right', 'onclick'=>'window.open(\''.route('users').'\', \'_self\');']) !!}
                        </div>
                    </div>
                    <!-- END Intro Category -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@section('javascript')
@parent
<script type="text/javascript">
$(function(){
    $(window).load(function(){
        //CHECKED ACCESS ALL
        var allAccessChecked = 0;
        $("input.access").each(function() {

            if($(this).prop('checked') == false){
                allAccessChecked += 1;
            }

        }); // each Function
        if(allAccessChecked == 0){
            $('#accessAll').prop('checked', true);
        }
        //CHECKED ADD ALL
        var allAddChecked = 0;
        $("input.add").each(function() {

            if($(this).prop('checked') == false){
                allAddChecked += 1;
            }

        }); // each Function
        if(allAddChecked == 0){
            $('#addAll').prop('checked', true);
        }
        //CHECKED EDIT ALL
        var allEditChecked = 0;
        $("input.edit").each(function() {

            if($(this).prop('checked') == false){
                allEditChecked += 1;
            }

        }); // each Function
        if(allEditChecked == 0){
            $('#editAll').prop('checked', true);
        }
        //CHECKED DELETE ALL
        var allDeleteChecked = 0;
        $("input.delete").each(function() {

            if($(this).prop('checked') == false){
                allDeleteChecked += 1;
            }

        }); // each Function
        if(allDeleteChecked == 0){
            $('#deleteAll').prop('checked', true);
        }
    });

    //ACCESS ALL
    $('input[type=checkbox]#accessAll').click(function(){
        if($('input[type=checkbox]#accessAll').prop('checked') == false){
            $('input[type=checkbox]#addAll').prop('checked', false);
            $('input[type=checkbox]#editAll').prop('checked', false);
            $('input[type=checkbox]#deleteAll').prop('checked', false);

            $('input[type=checkbox].access').prop('checked', false);
            $('input[type=checkbox].add').prop('checked', false);
            $('input[type=checkbox].edit').prop('checked', false);
            $('input[type=checkbox].delete').prop('checked', false);

            $('input[type=checkbox].add').attr('disabled', true);
            $('input[type=checkbox].edit').attr('disabled', true);
            $('input[type=checkbox].delete').attr('disabled', true);
        }else{
            $('input[type=checkbox].access').prop('checked', true);
            $('input[type=checkbox].add').attr('disabled', false);
            $('input[type=checkbox].edit').attr('disabled', false);
            $('input[type=checkbox].delete').attr('disabled', false);
        }
    });

    //ADD ALL
    $('input[type="checkbox"]#addAll').click(function(){
        if($('input[type="checkbox"]#addAll').prop('checked') == false){
            $('input[type=checkbox].add').prop('checked', false);
        }else{
            $('input[type=checkbox].add:not(:disabled)').each(function(){
                $(this).prop('checked', true);
            });
        }
    });
    //EDIT ALL
    $('input[type="checkbox"]#editAll').click(function(){
        if($('input[type="checkbox"]#editAll').prop('checked') == false){
            $('input[type=checkbox].edit').prop('checked', false);
        }else{
            $('input[type=checkbox].edit:not(:disabled)').each(function(){
                $(this).prop('checked', true);
            });
        }
    });
    //DELETE ALL
    $('input[type="checkbox"]#deleteAll').click(function(){
        if($('input[type="checkbox"]#deleteAll').prop('checked') == false){
            $('input[type=checkbox].delete').prop('checked', false);
        }else{
            $('input[type=checkbox].delete:not(:disabled)').each(function(){
                $(this).prop('checked', true);
            });
        }
    });

    //SELECT UNIQUE
    $('input[type=checkbox].access').click(function(){
        var id = $(this).attr('data-id');
        if($('input[type=checkbox]#access-'+id).prop('checked') == false){
            $('input[type=checkbox]#add-'+id).prop('checked', false);
            $('input[type=checkbox]#edit-'+id).prop('checked', false);
            $('input[type=checkbox]#delete-'+id).prop('checked', false);

            $('input[type=checkbox]#add-'+id).attr('disabled', true);
            $('input[type=checkbox]#edit-'+id).attr('disabled', true);
            $('input[type=checkbox]#delete-'+id).attr('disabled', true);
        }else{
            $('input[type=checkbox]#add-'+id).attr('disabled', false);
            $('input[type=checkbox]#edit-'+id).attr('disabled', false);
            $('input[type=checkbox]#delete-'+id).attr('disabled', false);
        }
    });
});
</script>
@stop
