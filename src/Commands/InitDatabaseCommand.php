<?php

namespace App\Commands;

use App\Core\Database\Database;
use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use App\Core\Interfaces\CommandInterface;

/**
 * InitDatabaseCommand class.
 *
 * This command is responsible for initializing the database by creating the necessary tables
 * and ensuring that the migrations table exists. It implements the CommandInterface.
 */
class InitDatabaseCommand implements CommandInterface {
    
    /** @var DatabaseAdapterInterface Database adapter instance. */
    private DatabaseAdapterInterface $db;

    /**
     * Constructor.
     * 
     * Initializes the database adapter instance.
     */
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Handle method.
     *
     * Executes the command logic to initialize the database. It clears the existing database
     * tables and creates the migrations table if it doesn't already exist.
     *
     * @param mixed ...$args Additional arguments (not used in this implementation).
     * @return void
     */
    public function handle(...$args): void {
        $this->clearDatabase();
        $this->db->query("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration_name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            );
        ");
    }

    /**
     * Clear database method.
     *
     * Clears all existing tables in the database. This method is typically called before
     * initializing the database to ensure a clean state.
     *
     * @return void
     */
    protected function clearDatabase(): void {
        // Disable foreign key checks to avoid issues with dropping tables that are referenced by foreign keys
        $this->db->getConnection()->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $result = $this->db->query("SHOW TABLES");

        if ($result) {
            $tables = $result->fetchAll(\PDO::FETCH_COLUMN);
            foreach ($tables as $table) {
                $this->db->getConnection()->exec("DROP TABLE IF EXISTS `$table`");
            }
        }

        // Re-enable foreign key checks
        $this->db->getConnection()->exec("SET FOREIGN_KEY_CHECKS = 1;");
    }
}
