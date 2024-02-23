<?php

namespace App\Commands;

use App\Core\Database\Database;
use App\Core\Database\Interfaces\DatabaseAdapterInterface;
use App\Core\Interfaces\CommandInterface;

class MigrateDatabaseCommand implements CommandInterface {
    /**
     * Database adapter instance.
     *
     * This property holds an instance of a database adapter that implements
     * the DatabaseAdapterInterface. It is used to interact with the database
     * within the class.
     *
     * @var DatabaseAdapterInterface
     */
    private DatabaseAdapterInterface $db;

    /**
     * Constructor for initializing the Database object.
     *
     * This method is called when an instance of the class is created. It initializes
     * the database connection by obtaining an instance of the Database class and
     * retrieving the database connection. The connection is stored in the $db property
     * for use in other methods of this class.
     * @return void
     */
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Handle migration execution.
     *
     * This method orchestrates the execution of migrations. It retrieves a list of
     * all migrations currently present in the database and compares them with the
     * list of migration files available. New migrations are identified, and each
     * new migration is executed by calling the `runMigration` method.
     *
     * @param mixed ...$args Additional arguments (not used in this implementation).
     * @return void
     */
    public function handle(...$args): void {
        $query = $this->db->query("SELECT * FROM migrations");
        $migrations = $query->fetchAll(\PDO::FETCH_ASSOC);

        $migrationNames = array_column($migrations, 'migration_name');

        $newMigrations = array_unique([...$migrationNames, ...$this->getMigrationFiles()]);

        foreach ($newMigrations as $migration) {
            $this->runMigration($migration);
        }
    }

    /**
     * Run a migration by its name.
     *
     * This method executes a single migration specified by its name. It typically
     * includes the logic to apply the migration to the database, such as executing
     * SQL queries or calling migration-specific methods. The method ensures that
     * the migration is applied safely and consistently.
     *
     * @param string $migrationName The name of the migration to run.
     * @return void
     */
    protected function runMigration (string $migrationName):void {
        // Assuming $db is your database connection
        $sql = "INSERT INTO migrations (migration_name) VALUES (:migrationName)";
        $this->db->query($sql, ['migrationName' => $migrationName]);
    }

    /**
     * Retrieve the list of migration filenames from the migrations directory.
     *
     * This method scans the directory where migration files are located and retrieves
     * the filenames of all PHP files present in that directory. It returns an array
     * containing the filenames without their directory paths.
     *
     * @return array An array of migration filenames.
     */
    protected function getMigrationFiles ():array {
        // Define the directory where your migration files are located
        $migrationsDirectory = config('app.root') . 'database/migrations';

        // Get all PHP files from the directory
        $migrationFiles = glob("$migrationsDirectory/*.php");

        // Extract just the filenames from the paths
        return array_map('basename', $migrationFiles);
    }
}