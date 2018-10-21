<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181020222358 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, iduser INT DEFAULT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_17BDE61F5E5C27E9 (iduser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61F5E5C27E9 FOREIGN KEY (iduser) REFERENCES user (id)');
        $this->addSql('DROP TABLE upload_file');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE upload_file (id INT AUTO_INCREMENT NOT NULL, iduser INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_81BB1695E5C27E9 (iduser), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upload_file ADD CONSTRAINT FK_81BB1695E5C27E9 FOREIGN KEY (iduser) REFERENCES user (id)');
        $this->addSql('DROP TABLE upload');
    }
}
