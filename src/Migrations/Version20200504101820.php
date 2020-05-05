<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504101820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP projet_id, CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE todo DROP todo_id, CHANGE todo_description todo_description VARCHAR(255) DEFAULT NULL, CHANGE todo_date_limite todo_date_limite DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE projet DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE projet ADD projet_id INT NOT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE todo ADD todo_id INT NOT NULL, CHANGE todo_description todo_description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE todo_date_limite todo_date_limite DATETIME DEFAULT \'NULL\'');
    }
}
