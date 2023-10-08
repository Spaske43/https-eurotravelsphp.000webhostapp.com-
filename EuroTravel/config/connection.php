<?php
define("SERVER","localhost");
define("DATABASE","id21005479_eurotravel");
define("USERNAME","id21005479_spaske");
define("PASSWORD","Yl5594913!");
define("LOG_FILE",$_SERVER["DOCUMENT_ROOT"]."/data/log.txt");

dodajLogZapis();
try{
    $conn = new
    PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8",USERNAME,PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
function dodajLogZapis()
{
    $stranicaNaKojojSeNalazi = $_SERVER["REQUEST_URI"];
    $vreme = Date("d. m. Y. h:i:s");
    $ipAdresaKorisnika = $_SERVER["REMOTE_ADDR"];

    $sadrzajFile = $stranicaNaKojojSeNalazi."__".$vreme."__".$ipAdresaKorisnika."\n";

    $file = fopen(LOG_FILE,"a");

    $upis = fwrite($file,$sadrzajFile);

    if($upis)
    {
        fclose($file);
    }
}

?>