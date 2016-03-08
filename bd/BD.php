<?php

    $bd = new mysqli("localhost", "root", "admin123*", "equipe3h16");
    if ($bd->connect_errno) {
        echo "Echec lors de la connexion à MySQL : (" . $bd->connect_errno . ") " . $bd->connect_error;
				$isBD = false;
    }
		
		$isBD = true;



