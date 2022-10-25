<?php


namespace App\Core;


interface ModelInterface
{
    public static function query(string $sql, array $params = [], bool $all = false): mixed;

    public static function all():mixed;

    public static function find(int $id):mixed;

    public static function count():int;

}