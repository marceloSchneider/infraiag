<?php

$link = new mysqli('localhost', 'root', 'pKtAxH53', 'infra');
$handle = fopen("../bloco_d.csv", 'r');
$row = 1;
$dados = array();
while(($data = fgetcsv($handle, 1000, ',')) !== FALSE){
    $num = count($data);
    for ($c=0; $c < $num; $c++){
        $dados[$row][$c] = $data[$c];
    }
    $row++;
}
fclose($handle);

foreach ($dados as $d)
{
    $exploded = explode('-', $d[1]);
    
    $query_local = "select id from Sala where numero = '$d[0]' and bloco_id = 2";

    $query_patch = "select id from Patch where rack_id = 2 and pilha = $exploded[1]";
    
    //echo $query_patch . '<br>';
    
    $local_id = $link->query($query_local);
    $localid = $local_id->fetch_assoc();
    
    $patch_id = $link->query($query_patch);
    $patchid = $patch_id->fetch_assoc();
    
    //echo $localid['id'] . '<br>';
    
    $query_update = "update PPorta set sala_id = '" .$localid['id'] . "' where patch_id = " . $patchid['id'] . " and numero = " . $exploded[2];
    
    $link->query($query_update);
}

