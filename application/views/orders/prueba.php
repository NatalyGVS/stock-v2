<?php

try
{ 
    $sql = "SELECT * FROM mesas ";

    foreach(  $this->db->query('SELECT * FROM mesas ' ) as $fila ) {
        print_r ($fila);
    }



}
catch(PDOException $e )  {
    print "Error " $e->getMessage() . "<br/>";
    die();



}
