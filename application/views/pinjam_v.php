<?php include ('templates/header.php')?>  

<!-- Card Container -->
<div class="container-fluid p-0 px-lg-2">
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
                        <table id="table_pinj" class="table table-striped text-nowrap" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th hidden></th>
                                    <th>Kode Pinjam</th>
                                    <th>ID Anggota</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tenor(bln)</th>
                                    <th>Bunga(%)</th>
                                    <th>Pinjam</th>                                   
                                    <th>Bunga(Rp)</th>                                                                    
                                    <th>Angs/Bln</th>
                                    <th>Angs ke</th>
                                    <th>Angs Msk</th>   
                                    <th>Sisa Pinjam</th>   
                                    <th>Status</th>                             
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
                <div class="modal-body">
                    <label>Tenor(bln)</label>
                    <input type="text" name="tenor" id="tenor" class="form-control" />
                    <span id="tenor_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-body">
                    <label>Bunga(%)</label>
                    <input type="text" name="bunga_pinj" id="bunga_pinj" class="form-control" />
                    <span id="tenor_error" class="text-danger"></span>
                    <br />
                </div>     
                <div class="modal-body">
                    <label>Jumlah Pinjaman</label>
                    <input type="text" name="pinj" id="pinj" class="form-control" />
                    <span id="pinj_error" class="text-danger"></span>
                    <br />
                </div>    
                <div class="modal-footer">
                    <input type="hidden" name="id_pinj" id="id_pinj" />
                    <input type="hidden" name="data_action" id="data_action"/>
                    <input type="submit" name="action" id="action" class="btn btn-success"/>     
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function()
{
    var row = true;
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>pinjam/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);

                table = $('#table_pinj').DataTable({
                    "scrollX": true,
                    colReorder: true,
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
                    // responsive: {
                    //     details: {
                    //         renderer: function ( api, rowIdx, columns ) {
                    //             var data = $.map( columns, function ( col, i ) {
                    //                 return col.hidden ?
                    //                     '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                    //                         '<td>'+col.title+'</td> '+
                    //                         '<td>'+':'+'&nbsp;&nbsp;&nbsp;&nbsp;'+col.data+'</td>'+
                    //                     '</tr>' :
                    //                     '';
                    //             } ).join('');
            
                    //             return data ?
                    //                 $('<table/>').append( data ) :
                    //                 false;
                    //         }
                    //     }
                    // }
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
            url:"<?php echo base_url(); ?>pinjam/action",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    $('#table_pinj').DataTable().clear().destroy();
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
        var id_pinj = $(this).attr('value');   
             
        $.ajax({
            url:"<?php echo base_url(); ?>pinjam/action",
            method:"POST",
            data:{
                id_pinj : id_pinj, 
                data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {      
                $('#userModal').modal('show');
                $('#id_pinj').val(id_pinj);
                $('#kode_angt').val(data.kode_angt);
                $('.modal-title').text('Ubah Data Pinjam');     
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });  

})

</script>