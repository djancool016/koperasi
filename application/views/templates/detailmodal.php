<!-- Modal 1-->
<div class="portfolio-modal modal fade" id="detailContentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal"></div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="modal-body">
                                <div id="detailContent">
                                    <div class="page">
                                    <h4 class="text-center font-weight-bold">BUKTI KAS MASUK</h4>
                                        <p class="text-center">No. Transaksi : ..../UM/..../20....<br></p>

                                        <table class = "table table-borderless table-sm" >
                                            <tbody>
                                        
                                            <tr>
                                                <td colspan="2">Terima Dari</td>
                                                <td colspan="4"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Nama</td>
                                                <td colspan="4">:  KSM SEDERHANA</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Jenis</td>
                                                <td colspan="4">:  Simpanan Pokok</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Rekening Tujuan</td>
                                                <td colspan="4">:  SIM00001</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Untuk Pembayaran</td>
                                                <td colspan="4">:  Setoran Simpanan Pokok Bulan X</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Jumlah</td>
                                                <td colspan="4">:  Rp. 250.000</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td colspan="2" style="width:33.3%">Penyetor<br><br><br>(   .................................   )</td>
                                                <td colspan="2" style="width:33.3%">Pembuku<br><br><br>(   .................................   )</td>
                                                <td colspan="2" style="width:33.3%">Kasir<br><br><br>(   .................................   )</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm" id="btnPrint">Cetak</button>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById("btnPrint").onclick = function() {
        printElement(document.getElementById("detailContent"));
        window.print();
    }

    function printElement(elem, append, delimiter) {
        var domClone = elem.cloneNode(true);

        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }

        if (append !== true) {
            $printSection.innerHTML = "";
        }

        else if (append === true) {
            if (typeof(delimiter) === "string") {
                $printSection.innerHTML += delimiter;
            }
            else if (typeof(delimiter) === "object") {
                $printSection.appendChlid(delimiter);
            }
        }

        $printSection.appendChild(domClone);
    }

</script>