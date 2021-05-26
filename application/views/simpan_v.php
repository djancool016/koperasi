<?php include ('templates/header.php')?>  

<!-- Card Container -->
<div class="container-fluid p-0  px-lg-2">
    <div class="d-xl-flex">
        <!-- Card Title-->
        <div class="col-12 col-xl-12 mx-auto">  
            <div class="card shadow mb-2">
                <div class="card-header d-sm-flex justify-content-between">
                    <div class="d-flex justify-content-center">
                        <h4 class="panel-title m-1 text-nowrap " >Rekening Simpanan Anggota</h4>
                    </div> 
                    <div class="m-1 d-flex justify-content-center">
                        <button type="button" id="add_button" class="btn btn-info btn-sm "><i class = "fa fa-wallet"></i></button>
                        <button type="button" name="edit" class="btn btn-warning btn-sm mx-2 edit" id="checkbox_edit" value=''><i class="fa fa-edit"></i></button>
                        <button type="button" name="delete" class="btn btn-danger btn-sm delete" id="checkbox_delete" value=''><i class="fa fa-trash"></i></button>              
                    </div>
                </div>
                <!-- Card Body -->
                <div class="panel-body m-4">
                    <span id="success_message"></span>
                    <div class="">
                        <table id="table_simpan" class="table table-striped text-nowrap" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th hidden></th>
                                    <th>No. Rek</th>
                                    <th>ID Anggota</th>
                                    <th>Pokok</th>
                                    <th>Wajib</th>
                                    <th>Sukarela</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Card Body -->
            </div>
        </div>
        <!-- End Card Title-->
    </div>
</div> 
<!-- End Container -->

<?php include ('templates/footer.php')?>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <label>ID Anggota</label>
                    <input type="text" name="kode_angt" id="kode_angt" class="form-control" />
                    <span id="kode_angt_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_simpan" id="id_simpan" />
                    <input type="hidden" name="data_action" id="data_action"/>
                    <input type="submit" name="action" id="action" class="btn btn-success"/>     
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

    var row = true;
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>simpan/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);

                table = $('#table_simpan').DataTable({
                    columnDefs: [ {
                    targets: 0,
                    data: "select",
                    searchable: false,
                    orderable: false,
                    className: 'select-checkbox',
                    width: "3%"
                    }],
                    select: {
                        style: 'single',           
                    },
                    order: [[ 1, 'asc' ]],
                    responsive: {
                        details: {
                            renderer: function ( api, rowIdx, columns ) {
                                var data = $.map( columns, function ( col, i ) {
                                    return col.hidden ?
                                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                            '<td>'+col.title+'</td> '+
                                            '<td>'+':'+'&nbsp;&nbsp;&nbsp;&nbsp;'+col.data+'</td>'+
                                        '</tr>' :
                                        '';
                                } ).join('');
            
                                return data ?
                                    $('<table/>').append( data ) :
                                    false;
                            }
                        }
                    }
                }); 

                if(row == true){
                    select_row();
                    row = false;
                }    
            }
        });
    }

    function select_row(){
        
        table.on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                
                var id = table.cell(indexes,1).render();
                document.getElementById('checkbox_delete').value = id
                document.getElementById('checkbox_edit').value = id;
                // console.log(indexes)
                // console.log(id)
            }
        });
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                
                var id = table.cell(indexes,1).render();
                document.getElementById('checkbox_delete').value = ''
                document.getElementById('checkbox_edit').value = '';

            }
        });
    }
    
    fetch_data();

    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Form Rekening Simpanan");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url(); ?>simpan/action",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    $('#table_simpan').DataTable().clear().destroy();
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                }
                if(data.error)
                {
                    $('#kode_angt_error').html(data.kode_angt_error);
                }
            }
        })
    });

    $(document).on('click','.edit', function()
    {       
        var id_simpan = $(this).attr('value');   
             
        $.ajax({
            url:"<?php echo base_url(); ?>simpan/action",
            method:"POST",
            data:{
                id_simpan : id_simpan, 
                data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {      
                $('#userModal').modal('show');
                $('#id_simpan').val(id_simpan);
                $('#kode_angt').val(data.kode_angt);
                $('.modal-title').text('Ubah Data Simpanan');     
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });  

    $(document).on('click','.delete', function()
    {
        var id_simpan = $(this).attr('value');  

        if(window.confirm('Hapus data?'))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>simpan/action",
                method:"POST",
                data:{
                    id_simpan : id_simpan, 
                    data_action:'Delete'},
                dataType:"json",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">Data berhasil dihapus</div>');
                        $('#table_simpan').DataTable().clear().destroy();      
                        fetch_data();
                    }
                },
                error: function(data)
                {
                    alert("ERROR \n 1. Anda mungkin belum memilih baris?\n 2. Rekening Simpanan yang pernah melakukan transaksi tidak dapat dihapus");
  
                }
            })
        }
    }); 

});

</script>