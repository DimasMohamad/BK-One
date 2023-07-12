<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data,true);
?>
<table id="tabel-data" class="table table-sm" style="font-size:14px;">
    <thead>
        <tr>
            <th colspan="2"><input id="nama_perusahaan" type="text" class="form-control" placeholder="Add Perusahaan"></th>
            <th width="10px"><input id="tanggal_survei" type="date" class="form-control"></th>
            <th ><input id="alamat" type="text" class="form-control" placeholder="Alamat"></th>
            <th ><input id="telepon" type="text" class="form-control" placeholder="Telepon"></th>
            <th ><input id="kontak_person" type="text" class="form-control" placeholder="Contact Person"></th>
            <th ><input id="email" type="text" class="form-control" placeholder="Email"></th>
            <th ><input id="produk" type="text" class="form-control" placeholder="Produk"></th>
            <th ><button class="btn btn-primary" onclick="simpandaftar()">Save</button></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Perusahaan</th>
            <th>Tanggal Survei</th>
            <th>Alamat</th>
            <th>Telephone / Mobile</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Produk Yang Dibeli</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$i."</td>";
            echo"<td style='vertical-align:top;'>".$h['name']."</td>";
            echo"<td style='vertical-align:top;'>".$h['survey_date']."</td>";
            echo"<td style='vertical-align:top;'>".$h['address']."</td>";
            echo"<td style='vertical-align:top;'>".$h['phone']."</td>";
            echo"<td style='vertical-align:top;'>".$h['contact_person']."</td>";
            echo"<td style='vertical-align:top;'>".$h['email']."</td>";
            echo"<td style='vertical-align:top;'>".$h['product']."</td>";
            echo"<td style='vertical-align:top;'></td>";
            echo"</tr>";
            $i++;
        }
        
        ?>
    </tbody>
</table>

<script>
    $('#tabel-data').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
    });

    function pesan(txt){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: txt
        })
    }

    function pesan_sukses(txt){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: txt
        })
    }

    function simpandaftar(){
        var name = $("#nama_perusahaan").val();
        var survey_date = $("#tanggal_survei").val();
        var address = $("#alamat").val();
        var phone = $("#telepon").val();
        var contact_person = $("#kontak_person").val();
        var email = $("#email").val();
        var product = $("#produk").val();
        if(name === ''){
            pesan('Nama Perusahaan belum diisi');
        }else if(survey_date === ''){
            pesan('Tanggal Survei belum diisi');
        }else if(address === ''){
            pesan('Alamat belum diisi');
        }else if(phone === ''){
            pesan('Nomor Telepon belum diisi');
        }else if(contact_person === ''){
            pesan('Contact Person belum diisi');
        }else if(email === ''){
            pesan('Email belum diisi');
        }else if(product === ''){
            pesan('Produk belum diisi');
        }else{            
            $.ajax({
                url: "<?= base_url('Busines_partner/simpan_daftar'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    name: name,
                    survey_date: survey_date,
                    address: address,
                    phone: phone,
                    contact_person: contact_person,
                    email: email,
                    product: product,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                },
                    success: function(){
                    pesan_sukses('Tersimpan');
                    tampildata();
                    document.getElementById("nama_perusahaan").value = "";
                    document.getElementById("tanggal_survei").value = "";
                    document.getElementById("alamat").value = "";
                    document.getElementById("telepon").value = "";
                    document.getElementById("kontak_person").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("produk").value = "";
                },
                error: function(){
                    pesan('Gagal menyimpan data');
                }
            });
        }
    }

    function tampildata(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildatabp").innerHTML = '';
        $.get("<?= base_url('Busines_partner/tb_daftar_rekanan_tidakterpilih') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatabp").html(data);
        });
    }
    
</script>