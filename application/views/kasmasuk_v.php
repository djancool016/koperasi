<?php include ('templates/header.php')?>  

<!-- Card Container -->
<div class="container-fluid p-0  px-lg-2">
    <div class="d-xl-flex">
        <!-- Card Title-->
        <div class="col-12 col-xl-12 mx-auto">  
            <div class="card shadow mb-2">
                <div class="card-header d-sm-flex justify-content-between">
                    <div class="d-flex justify-content-center">
                        <h4 class="panel-title m-1 text-nowrap " >Kas Masuk</h4>
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
                        <table id="table_trans_simp" class="table table-striped text-nowrap" width="100%"> 
                            <thead>
                                <tr class="text-center">
                                    <th></th>
                                    <th hidden>id Trans</th>
                                    <th>No. Transaksi</th>
                                    <th>No. Rekening</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>                         
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