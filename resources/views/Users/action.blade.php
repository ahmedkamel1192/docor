@if($model->id != 1)
<button id ="delete{{$id}}" class="delete btn btn-danger" data-user_id="{{  $id }}"><i class="fa fa-trash"></i></button>
<button id ="block{{$id}}"  class="{{ $model->is_blocked == 0 ?  'btn btn-danger' : ' btn btn-info' }}  "  data-user_id="{{  $id }}" >{{$model->is_blocked == 0 ? 'block' : 'unblock'}} </button>

@endif
<script>
    $('#block{{$id}}').click(function () {
        var user_id = $(this).data('user_id'); //or == {{$id}}
            $.ajax({
                url: "/block/"+user_id,
                type: 'POST',
                datatype: 'JSON',
                data : {
               '_method' : 'post',
               '_token' : '{{ csrf_token() }}'
                   },
             
                success: function () {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                }
            })
        
    })

    $('#delete{{$id}}').click(function () {
        var user_id = {{$id}};
        if(confirm('are you sure?')){

            $.ajax({
                url: "/delete/"+user_id,
                type: 'DELETE',
                datatype: 'JSON',
               data : {
               '_method' : 'delete',
               '_token' : '{{ csrf_token() }}'
                   },
                success: function () {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                }
            })
        }
    })
</script>