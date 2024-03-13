<?php

namespace PostgreSQLTutorial;

/**
 * Создание в PostgreSQL таблицы из демонстрации PHP
 */
class PGSQLCreateTable
{
    /**
     * объект PDO
     * @var \PDO
     */
    private $pdo;

    /**
     * инициализация объекта с объектом \PDO
     * @тип параметра $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * создание таблиц
     */
    public function createTables()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS public.users
        (
            id serial PRIMARY KEY,
            name character varying(50) COLLATE pg_catalog."default",
            lastname character varying(50) COLLATE pg_catalog."default",
            age integer,
            description text COLLATE pg_catalog."default"
        );';

        $this->pdo->exec($sql);

        return $this;
    }
}