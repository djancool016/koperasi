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
                        <button type="button" name="detailmodal" class="btn btn-primary btn-sm mr-2 detailmodal"><i class="fa fa-print"></i></button>  
                        <button type="button" id="add_button" class="btn btn-info btn-sm mr-2 "><i class = "fa fa-wallet"></i></button>
                        <button type="button" name="edit" class="btn btn-warning btn-sm mr-2 edit" id="checkbox_edit" value=''><i class="fa fa-edit"></i></button>
                        <button type="button" name="delete" class="btn btn-danger btn-sm delete" id="checkbox_delete" value=''><i class="fa fa-trash"></i></button>              
                    </div>
                </div>
                <!-- Card Body -->
                <div class="panel-body m-4">
                    <span id="success_message"></span>
                    <div class="">
                        <table id="table_trans_angs" class="table table-striped text-nowrap" width="100%"> 
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th hidden>id_trans</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Pinjam</th>
                                    <th>Tgl</th>
                                    <th>Nominal</th>                          
                                </tr>
                            </thead>
                            <tbody id="main-table">
                                
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

<?php include ('templates/detailmodal.php')?>
<?php include ('templates/footer.php')?>


<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <label>Kode Pinjam</label>
                    <input type="text" name="kode_pinj" id="kode_pinj" class="form-control" />
                    <span id="kode_pinj_error" class="text-danger"></span>
                    <label>Nominal</label>
                    <input type="text" name="nominal" id="nominal" class="form-control" />
                    <span id="nominal_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_trans" id="id_trans" />
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
            url:"<?php echo base_url(); ?>tranangs/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('#main-table').html(data);

                table = $('#table_trans_angs').DataTable({
                    columnDefs: 
                    [{
                        targets: 0,
                        data: "select",
                        searchable: false,
                        orderable: false,
                        className: 'select-checkbox',
                        width: "3%"
                    }],

                    select: 
                    {
                        style:    'single',           
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
                console.log(indexes)
                console.log(id)
                if(indexes < 0){
                    console.log('null')
                }
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
        $('.modal-title').text("Form Angsuran");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'tranangs/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    $('#table_trans_angs').DataTable().clear().destroy();
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                }
                if(data.error)
                {
                    $('#kode_pinj_error').html(data.kode_pinj_error);
                    $('#nominal_error').html(data.nominal_error);
                }
            }
        });
    });

    $(document).on('click','.edit', function()
    {       
        var id_trans = $(this).attr('value');  
        
        $.ajax({
            url:"<?php echo base_url(); ?>tranangs/action",
            method:"POST",
            data:{
                id_trans : id_trans, 
                data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {      
                $('#userModal').modal('show');
                $('#id_trans').val(id_trans);
                $('#kode_pinj').val(data.kode_pinj);
                $('#nominal').val(data.nominal);
                $('.modal-title').text('Ubah Data Angsuran');     
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        });
    }); 

    $(document).on('click','.delete', function()
    {
        var id_trans = $(this).attr('value');  
        if(window.confirm('Hapus data?'))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>tranangs/action",
                method:"POST",
                data:{
                    id_trans : id_trans, 
                    data_action:'Delete'},
                dataType:"json",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">Data berhasil dihapus</div>');
                        $('#table_trans_angs').DataTable().clear().destroy();      
                        fetch_data();
                    }
                },
                error: function(data)
                {
                    alert("ERROR \n 1. Anda mungkin belum memilih baris?\n 2. Anggota yang memiliki data transaksi tidak dapat dihapus\nsolusi : ubah status menjadi 'tidak aktif'");
  
                }
            })
        }
    }); 

    $(document).on('click', '.detailmodal', function()
    {
        $('#detailContentModal').modal('show');

    }); 

    
});

</script>