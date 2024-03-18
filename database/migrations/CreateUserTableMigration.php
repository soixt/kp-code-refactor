<?php

namespace App\Database\Migrations;

use App\Infrastructure\Database\AbstractMigration;
use App\Infrastructure\Database\Interfaces\DatabaseAdapterInterface;

class CreateUserTableMigration extends AbstractMigration
{
    /**
     * Constructor.
     *
     * @param DatabaseAdapterInterface $database The database adapter instance
     */
    public function __construct(DatabaseAdapterInterface $database)
    {
        // Call the parent constructor to initialize the database adapter
        parent::__construct($database);
    }

    /**
     * Define the migration operations.
     *
     * @return string|array The SQL queries or an array of SQL queries to perform for the migration
     */
    public function up(): string|array
    {
        // Define the SQL query to create the user table
        return "
            CREATE TABLE IF NOT EXISTS user (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL
            );
        ";
    }
}
