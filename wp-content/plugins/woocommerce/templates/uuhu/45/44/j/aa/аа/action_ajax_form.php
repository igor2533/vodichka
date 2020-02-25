<?php
global $user_ID;
if (isset($_POST["ocenka"].get_the_ID()) ) { 

	// Формируем массив для JSON ответа
    $result = array(
    	'ocenka' => $_POST["ocenka"],
    	
    ); 




update_field( 'оценка_судьи_за_содержание1', '9', get_the_ID());




    // Переводим массив в JSON
    echo 'dd'; 
}

?>
 