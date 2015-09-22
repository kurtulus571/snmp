<?php
require_once "snmpclass.php";
$a = new Yazici("ip adresi girin");
echo "Acik Kalma Suresi = ".$a->uptime()."\r\n";
echo "Yazici Seri Nosu = ".$a->seri()."\r\n";
echo "Yazici Ismi = ".$a->ad()."\r\n";
echo "Alinan Cikti Sayisi = ".$a->sayfa_sayisi()."\r\n";
echo "Yazici Toneri = ".$a->toner()."\r\n";
echo "Yazicinin Host ismi = ".$a->host()."\r\n";
?>
