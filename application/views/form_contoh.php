<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <style type="text/css" media="screen">
        #info{
            font-family: tahoma;
            color: red;
            display: inline;
        }
    </style>
</head>
<body>
    <?php echo form_open('#',array('id'=>'form')); ?>
    <div id="info"></div>
    <p>
    <label>NIP</label> <br>
    <input type="text" name="txtNIP" id="nip" placeholder="NIP">
    </p>
    <p>
    <label>Name</label> <br>
    <input type="text" name="txtNama" id="nama" placeholder="Nama">
    </p>
    <button type="button" onclick="do_proses()">Proses</button>
    <?php echo form_close(); ?>
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js');?>" type="text/javascript"></script>
    <script>
        function do_proses(){
            $.ajax({
                url: '<?php echo site_url('welcome/proses/') ?>',
                type:'POST',
                dataType: 'json',
                data: $('#form').serialize(),
                encode: true,
                success: function(data)
                    {
                        if(!data.success){
                            if(data.errors) {
                                $('#info').html(data.errors);
                            }
                        } else {
                            alert(data.message);
                        }
                    }        
            })
        }
    </script>

</body>
</html>