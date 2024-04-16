<!-- Abstrakte Klasse für alle anderen Repositories -->
<?php

abstract class AbstractRepository {
    public $database;

    public function __construct($database) {
        $this->database = $database;
    }
}