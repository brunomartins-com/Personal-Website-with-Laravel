@extends('admin.raw-template')

@section('sidebar')
    @include('admin.sidebar')
@stop

@section('javascript')
<script>
    $('#page-container').addClass('sidebar-l sidebar-o side-scroll header-navbar-fixed');
    $('#hidden-show-sidebar').addClass('show');
    $('#logoNoSidebar').remove();
</script>
@stop