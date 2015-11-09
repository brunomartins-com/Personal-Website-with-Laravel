<script>
//START SCRIPT
$(document).ready(function(){
    //ADD NEW ITEM CODE
    $('#form_<?=$modalName;?>').submit(function(e){
        e.preventDefault();
        var title = $('input#title<?=$modalName;?>').val();
        if(title.length == 0){
            //CUSTOM ALERT SHOW THE WARNING
            bootbox.alert("Enter the input");
            $('input#title<?=$modalName;?>').focus();
        }else{
            //ADD NEW CATEGORY
            var sendData = { "title":title, "databaseTable":"<?=$modalDatabaseTable;?>", "_token":$('#form_<?=$modalName;?> input[name=_token]').val() };
            $.ajax({
                url: "<?=route('selectCategoryAdd');?>",
                type: "post",
                data: sendData,
                dataType:"json"
            }).done(function(data){
                if (data.error == 1) {
                    bootbox.alert("Title already exists!");
                    $('input#title<?=$modalName;?>').val('');
                }
                if (data.error == 2) {
                    bootbox.alert("An error occurred while saving");
                }
                if (data.error == 3) {
                    bootbox.alert("Error!<br />Enter all inputs!");
                }
                bootbox.alert("Successfully Saved!");
                $('#modal<?=$modalName;?>').load('<?=route('selectCategory', [$modalTitle, $modalName, $modalDatabaseTable]);?>', function(result){
                    $('#modal<?=$modalName;?>').modal({show:true});
                });
                return false;
            }).fail(function(){
                bootbox.alert("An error occurred while saving");
                $('input#title<?=$modalName;?>').val('');
            });
        }
    });
    //OPEN EDIT INPUT FUNCTION
    $(".btn-edit").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('p#p'+id).addClass('hide');
        $('input#categoryTitle'+id).removeClass('hide');
        $('input#categoryTitle'+id).focus();
        $(this).addClass('hide');
    });
    //INPUT PRESS ENTER FUNCTION
    $('input.hide').keypress(function(e){
        var id = $(this).attr('data-id');
        var inputRequired = $(this).attr('required');
        var inputValue = $(this).val();
        /* * Verify if Keycode is the event (for IE and others browsers) * if not, get Which event (Firefox) */
        var key = (e.keyCode?e.keyCode:e.which);
        /* Verify if key pressed was ENTER */
        if(key == 13){
            if(inputRequired == 'required' && inputValue == ''){
                alert('Input Required!');
            }else{
                var sendData = { 'databaseTable' : '<?=$modalDatabaseTable;?>', 'id' : id, 'title' : inputValue, "_token":$('#form_<?=$modalName;?> input[name=_token]').val() };
                $.ajax({
                    url: "<?=route('selectCategoryEdit');?>",
                    type : "put",
                    data: sendData,
                    dataType: "json"
                }).done(function(data){
                    if (data.error == 1) {
                        bootbox.alert("Title already exists!", function (){
                            $('input#categoryTitle'+id).val('');
                            $('input#categoryTitle'+id).focus();
                        });
                    }
                    if (data.error == 2) {
                        bootbox.alert("An error occurred while saving", function (){
                            $('input#categoryTitle'+id).focus();
                        });
                    }
                    if (data.error == 3) {
                        bootbox.alert("Enter all inputs!", function (){
                            $('input#categoryTitle'+id).focus();
                        });
                    }
                    bootbox.alert("Succesfully Saved!");
                    $('input#categoryTitle'+id).addClass('hide');
                    r = data['data'];
                    if(r == ''){ r = '- - -'; }
                    $('p#p'+id).html(r);
                    $('p#p'+id).removeClass('hide');
                    $('.btn-edit').removeClass('hide');
                    return false;
                }).fail(function(){
                    bootbox.alert("An error occurred while saving");
                    $('input#categoryTitle'+id).val('');
                });
            }
        }else{
            return true;
        }
    });
    //ITEM DELETE FUNCTION
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        bootbox.confirm('Are you sure you want to delete?<br />You can\'t undo this action abd all items with this <?=$modalTitle;?> will be disfellowshipped!', function(result){
            if (result == true) {
                var sendData = {'databaseTable' : '<?=$modalDatabaseTable;?>', 'id' : id, '_token' : $('#form_<?=$modalName;?> input[name=_token]').val() };
                $.ajax({
                    url : "<?=route('selectCategoryDelete');?>",
                    type : "delete",
                    data: sendData,
                    dataType: "json"
                }).done(function(data){
                    if(data.error == 1) {
                        bootbox.alert("Error while delete<br />Please try again!");
                    }
                    if (data.error == 2) {
                        bootbox.alert("An error occurred while deleting");
                    }
                    if (data.error == 3) {
                        bootbox.alert("An error occurred while deleting");
                    }
                    if(data.error == 0){
                        $('table.categoryList tr#'+id).remove();
                        bootbox.alert("Successfully Deleted!");
                    }
                }).fail(function(){
                    bootbox.alert("An error occurred while deleting");
                });
            }
        });
        return false;
    });
    //CLOSE MODAL FUNCTION
    $('[data-dismiss="modal"]').click(function(){
        var sendData = {'databaseTable' : '<?=$modalDatabaseTable;?>', '_token' : $('#form_<?=$modalName;?> input[name=_token]').val() };
        $.ajax({
            url : "<?=route('selectCategoryRefresh');?>",
            type : "post",
            data: sendData,
            dataType: "json"
        }).done(function(data){
            var categories = '<option value="">Choose...</option>';
            $.each(data, function (key, val) {
                categories += '<option value="' + val.id + '">' + val.title + '</option>';
            });
            $(".box<?=$modalName;?> select").html(categories);
        });
    });
});
</script>
<div class="modal-lg modal-dialog modal-dialog-top">
    <div class="modal-content">
        <!-- Apps Block -->
        <div class="block block-themed block-transparent">
            <div class="block-header bg-gray-darker">
                <ul class="block-options">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">{{ $modalTitle }}</h3>
            </div>
            <div class="block-content">
                {!! Form::open([
                    'id' => 'form_'.$modalName,
                    'method' => 'post',
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data'
                    ])
                !!}
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5>Add New</h5>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                            <div class="form-input">
                                {!! Form::text('title'.$modalName, '', ['id' => 'title'.$modalName, 'placeholder' => 'Title', 'maxlength' => '45', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-2 col-xs-2" style="text-align:left;">
                            {!! Form::submit('Add', ['id' => 'btn-add', 'class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                @if(count($categories) > 0)
                <!-- #lista -->
                <table class="responsive table table-striped table-bordered dataTable categoryList">
                    <thead>
                        <tr role="row">
                            <th style="width:50px; text-align:center;">ID</th>
                            <th>Title</th>
                            <th class="sorting_none" style="width:40px; text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bg2 = 0; ?>
                        @foreach($categories as $category)
                        <?php
                            $bg2 = $bg2+1;
                            if($bg2 % 2==0){ $ex2 = "odd"; }else{ $ex2 = "even"; }
                        ?>
                        <tr class="<?=$ex2;?>" id="{{ $category->id }}">
                            <td style="text-align:center;">{{ $category->id }}</td>
                            <td>
                                <p id="p{{ $category->id }}">{{ $category->title }}</p>
                                {!! Form::text('categoryTitle'.$category->id, $category->title, ['id' => 'categoryTitle'.$category->id, 'data-id'=> $category->id, 'class' => 'form-control hide',
                                               'placeholder' => 'title', 'required' => 'required']) !!}
                            </td>
                            <td align="center">
                                {!! Form::button('<i class="fa fa-pencil"></i>', ['title'=>'Edit', 'data-id' => $category->id, 'class'=>'btn btn-xs btn-primary btn-edit']) !!}

                                {!! Form::button('<i class="fa fa-trash"></i>', ['title'=>'Delete', 'data-id' => $category->id, 'class'=>'btn btn-xs btn-danger btn-delete']) !!}

                                <!--<a href="#" data-id="{d{ $category->id }}" class="btn btn-xs btn-primary edit" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <a href="#" data-id="{d{ $category->id }}" class="btn btn-xs btn-danger categoryDelete" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- /#lista -->
                @else
                <center>None {{ $modalTitle }}</center>
                @endif
            </div>
        </div>
        <!-- END Apps Block -->
    </div>
</div>