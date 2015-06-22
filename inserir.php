<?php

	$link = mysqli_connect('localhost', 'root', 'pKtAxH53', 'infra');

	$sala_ini = 301;
	$sala_fim = 312;  
	$bloco =  5;
	$pavimento = 8; 

	for($i=$sala_ini;$i<=$sala_fim;$i++)
	{

		$query = "insert into Sala(pavimento_id, bloco_id, numero) values($pavimento, $bloco, $i)";
	
		$result = $link->query($query);
	}
