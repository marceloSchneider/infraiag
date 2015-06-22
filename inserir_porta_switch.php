<?php

$link = new mysqli('localhost', 'root', 'pKtAxH53', 'cabling');
$handle = fopen("../bloco_c_load.csv", 'r');
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
    if ($d[1]) {
        $pilha = explode('_', $d[1]);
        $pilha = substr($pilha[2], -1);
        if ($pilha){
        $exploded = explode('-', $d[0]);
    
    
    
        $query_patch = "select id from Patch where rack_id = 4 and pilha = $exploded[1]";

        $patchid = $link->query($query_patch)->fetch_assoc();

        $q_switchId = "select id from Switchs where identificacao = '$d[1]'";
        $switchId = $link->query($q_switchId)->fetch_assoc();

        $q_porta_switch = "select id from PortaSwitch where switch_id =" . $switchId['id'] . " and num_porta = '" . getPilha($pilha, $d[2]) ."'";
        //echo $q_porta_switch . '<br>';


        $portaSwitch = $link->query($q_porta_switch)->fetch_assoc();
        //echo $q_porta_switch . '<br>';

        $query_update = "update PPorta set porta_switch_id = " .$portaSwitch['id'] . " where patch_id = " . $patchid['id'] . " and numero = " . $exploded[2];
        echo $query_update . "\n";

        if(!$link->query($query_update)){
            echo $link->errno . "\n";
        }
        }
        //$link->query($query_update);
    }
}

function getPilha($pilha, $porta)
{
    if($pilha == 'P') {$pilha = '0';}
    return $pilha.'/'.'0/'.$porta;
}