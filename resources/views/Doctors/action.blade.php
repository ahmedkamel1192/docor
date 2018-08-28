
@if($model->id != 1)
<button id ="delete{{$id}}" class="delete btn btn-danger" data-doctor_id="{{  $id }}"><i class="fa fa-trash"></i></button>
<button id ="verify{{$id}}"  class="{{ $model->is_verified == 1 ?  'btn btn-danger' : ' btn btn-info' }}  "  data-doctor_id="{{  $id }}" >{{$model->is_verified == 1 ? 'invalidate' : 'verify'}} </button>
<button id ="block{{$id}}"  class="{{ $model->is_blocked == 0 ?  'btn btn-danger' : ' btn btn-info' }}  "  data-doctor_id="{{  $id }}" >{{$model->is_blocked == 0 ? 'block' : 'unblock'}} </button>

@endif
<script>
    $('#verify{{$id}}').click(function () {
        var doctor_id = $(this).data('doctor_id'); //or == {{$id}}
            $.ajax({
                url: "/verify/"+doctor_id,
                type: 'GET',
                datatype: 'JSON',
             
                success: function () {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                }
            })
        
    })
    $('#block{{$id}}').click(function () {
        var doctor_id = $(this).data('doctor_id'); //or == {{$id}}
            $.ajax({
                url: "/block/"+doctor_id,
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
        var doctor_id = {{$id}};
        if(confirm('are you sure?')){

            $.ajax({
                url: "/delete/"+doctor_id,
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
