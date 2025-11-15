<?php

class MyDB extends SQLite3
{
    public function __construct(){
        $this->open('../BD/database.db');
    }
}

?>
