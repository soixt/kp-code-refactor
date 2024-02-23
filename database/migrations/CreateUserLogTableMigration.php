<?php

namespace App\Database\Migrations;

use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use App\Core\Migrations\AbstractMigration;

class CreateUserLogTableMigration extends AbstractMigration
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
        // Define the SQL query to create the user log table
        return "
            CREATE TABLE IF NOT EXISTS user_log (
                id INT AUTO_INCREMENT PRIMARY KEY,
                action VARCHAR(255) NOT NULL,
                user_id INT NOT NULL,
                log_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES user(id)
            )
        ";
    }
}
