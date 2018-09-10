<a href ="{{ url('categories/'.$id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
<button id="categoryDelete{{$id}}" class="delete btn btn-danger" ><i class="fa fa-trash"></i></button>
<script>
 $('#categoryDelete{{$id}}').click(function () {
        var category_id = {{$id}};
        if(confirm('are you sure?')){

            $.ajax({
                url: "categories/delete/"+category_id,
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