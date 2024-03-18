<?php

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\Interfaces\DatabaseAdapterInterface;

abstract class AbstractMigration
{
    /** @var DatabaseAdapterInterface The database adapter instance */
    protected DatabaseAdapterInterface $database;

    /**
     * Constructor.
     *
     * @param DatabaseAdapterInterface $database The database adapter instance
     */
    public function __construct(DatabaseAdapterInterface $database)
    {
        $this->database = $database;
        
        // Automatically run the migration when a migration instance is created
        $this->migrate();
    }

    /**
     * Define the migration operations.
     *
     * @return string|array The SQL queries or an array of SQL queries to perform for the migration
     */
    abstract public function up(): string|array;

    /**
     * Perform the migration.
     */
    protected function migrate(): void
    {
        // Get the SQL queries from the up() method
        $changes = $this->up();

        // Execute each SQL query
        if (is_string($changes)) {
            $this->database->query($changes);
        } else {
            foreach ($changes as $change) {
                $this->database->query($change);
            }
        }
    }
}
