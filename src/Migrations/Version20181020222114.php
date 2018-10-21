<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181020222114 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_file ADD iduser INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload_file ADD CONSTRAINT FK_81BB1695E5C27E9 FOREIGN KEY (iduser) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_81BB1695E5C27E9 ON upload_file (iduser)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE upload_file DROP FOREIGN KEY FK_81BB1695E5C27E9');
        $this->addSql('DROP INDEX IDX_81BB1695E5C27E9 ON upload_file');
        $this->addSql('ALTER TABLE upload_file DROP iduser');
    }
}
