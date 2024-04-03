<?php

abstract class AbstractRepository {
    public $database;

    public function __construct($database) {
        $this->database = $database;
    }
}