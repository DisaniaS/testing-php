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

    // Создание таблицы с пользователями
    public function createTableUsers()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS public.users
        (
            id serial PRIMARY KEY,
            name character varying(150) COLLATE pg_catalog."default",
            lastname character varying(150) COLLATE pg_catalog."default",
            age integer,
            description text COLLATE pg_catalog."default"
        );';

        $this->pdo->exec($sql);

        return $this;
    }


    // Создание таблицы с постами
    public function createTablePosts()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS public.posts
        (
            id serial PRIMARY KEY,
            title character varying(150) COLLATE pg_catalog."default",
            text text COLLATE pg_catalog."default",
            created date
        );';

        $this->pdo->exec($sql);

        return $this;
    }
}

?>