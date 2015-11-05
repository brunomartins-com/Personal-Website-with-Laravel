@extends('admin.sidebar-template')

@section('title', 'Skills | ')

@section('head')
@parent
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/datatables/jquery.dataTables.min.css') }}">
@stop

@section('page-content')
@parent
<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Skills <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Skills</li>
                    <li>List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">
                    {!! Form::button('<i class="fa fa-plus"></i> Add New', ['class'=>'btn btn-success', 'onclick'=>'window.open(\''.route('skillsAdd').'\', \'_self\');']) !!}
                    {!! Form::button('<i class="fa fa-list"></i> Update Order', ['class'=>'btn btn-inverse push-10-l', 'onclick'=>'window.open(\''.route('skillsOrder').'\', \'_self\');']) !!}
                </h3>
            </div>
            <div class="block-content">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {!! Session::get('success') !!}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Id</th>
                            <th>Name</th>
                            <th class="text-center sorting-none" style="width: 70px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <td>{{ $skill->sortorder }}</td>
                        <td class="font-w600">{{ $skill->name }}</td>
                        <td class="text-center">
                                {!! Form::button('<i class="fa fa-pencil"></i>', ['title'=>'Edit', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn-primary',
                                'onclick'=>'window.open(\''.route('skillsEdit', $skill->skillsId).'\', \'_self\')']) !!}

                                {!! Form::open([
                                    'id' => 'formDelete'.$skill->skillsId,
                                    'method' => 'delete',
                                    'enctype' => 'multipart/form-data',
                                    'url' => ''
                                    ])
                                !!}
                                {!! Form::hidden('skillsId', $skill->skillsId) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['title'=>'Delete', 'data-toggle'=>'tooltip', 'class'=>'btn btn-xs btn-danger btn-delete',
                                'data-url'=>route('skillsDelete'), 'data-form'=>true, 'data-id-form'=>'formDelete'.$skill->skillsId]) !!}
                                {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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
    <!-- Page JS Plugins -->
<script src="{{ asset('assets/admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('assets/admin/js/pages/base_tables_datatables.js') }}"></script>
<!-- Personalizing dataTable -->
<script>
jQuery(function(){
    jQuery('.js-dataTable-full').dataTable({
        columnDefs: [ { orderable: false, targets: 'sorting-none' } ],
        pageLength: 10,
        lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
    });
});
</script>
@stop
