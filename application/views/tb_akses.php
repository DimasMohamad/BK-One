<?php
echo"<table border='1' rules='all' class='table table-sm'>";
foreach($menu as $m){
echo"<tr>";
echo"<td style='vertical-align:top;'>".$m['menu']."</td>";
echo"<td style='vertical-align:top;'>";
    foreach($submenu as $sb){
        if($sb['id_menu']==$m['id_menu']){
            foreach($akses as $a){
                if($a['id_menu']== $m['id_menu'] && $a['id_sub_menu']==$sb['id_sub_menu']){
                    if(!$a['id_akses']==0){
                        echo "<i class='bi bi-check-circle' style='cursor:pointer;color:#0d6efd;' onclick='tutup_akses(".$a['id_akses'].")'></i>&nbsp;".$sb['sub_menu']."<br>";
                    }else{
                        echo "<i class='bi bi-x-circle' style='cursor:pointer;color:#dc3545;' onclick='buka_akses(".$m['id_menu'].",".$sb['id_sub_menu'].")'></i>&nbsp;".$sb['sub_menu']."<br>";
                    }
                }
            }
        }
    }
echo"</td>";
echo"</tr>";
}
echo"</table>";
?>