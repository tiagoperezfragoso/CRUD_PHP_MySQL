<?php

$qtd_itens = filter_input(INPUT_POST, 'qtd_itens', FILTER_SANITIZE_STRING);

echo $qtd_itens;

 				if ($qtd_itens == "5") {

						echo "funcionou 5";

				}else if ($qtd_itens== "10"){

					echo "não funcionou 10";
				}else

					echo "Não Funcionou"				

?>
