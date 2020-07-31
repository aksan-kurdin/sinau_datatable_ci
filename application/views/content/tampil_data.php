<div class="col-md-12">
    <?php echo form_open('#', array('id'=>'myform')); ?>

    <div id="info"></div>

    <div class="form-group">
        <label>NAMA</label>
        <input type="text" class="form-control" name="txtNama" placeholder="NAMA">
    </div>

    <div class="form-group">
        <label>KELAMIN</label>
        <select name="txtKelamin" class="form-control">
        <option value="">KELAMIN</option>
        <option value="L">Laki-Laki</option>
        <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>TELEPON</label>
        <input type="text" class="form-control" name="txtTelp" placeholder="TELEPON">
    </div>

    <div class="form-group">
        <label>KTP</label>
        <input type="text" class="form-control" name="txtKTP" placeholder="TELEKTPPON">
    </div>

    <button type="button" class="btn btn-success simpan" onclick="simpan()">Simpan</button>
    <button type="button" class="btn btn-primary ganti" onclick="ganti()">Ganti</button>

    <?php echo form_close(); ?>
</div>

<div class="col-md-12">
    <h3 class="page-header">Data</h3>
    <div id="error"></div>
    <table id="pegawai" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Kelamin</th>
                <th>Telp</th>
                <th>KTP</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script type="text/javascript">
    $('.ganti').attr('disabled', 'disabled');
    function simpan(){
        $.ajax({
            url: '<?php echo site_url('aplikasi/simpan') ?>',
            type: 'POST',
            dataType:'json',
            data: $('#myform').serialize(),
            encode: true,
            success: function (data) {
                if (!data.success){
                    if(data.errors){
                        $('#info').addClass('alert alert-danger').html(data.errors);
                        return false;
                    }
                    else{
                        $('#info').removeClass('alert alert-danger');
                        alert(data.message);
                        window.location.reload();
                    }
                }
            }
        })
    }

    $(document).ready(function(){
        $('#pegawai').DataTable({
            "processing": true,
            "ajax": {
                "url": "<?php echo site_url('aplikasi/data_pegawai') ?>",
                "type": "POST"            
            },
            "sPaginationType": "full_numbers",
            "order": [[0,"asc"]],
            "columnDefs":[
                {"bVisible":true,},
                {"bSortable":false, "aTargets":["no-sort"]}
            ]   
        });
    });        
    
</script>