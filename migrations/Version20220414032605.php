<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414032605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vol ADD airline_id INT NOT NULL');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EB130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('CREATE INDEX IDX_95C97EB130D0C16 ON vol (airline_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB130D0C16');
        $this->addSql('DROP INDEX IDX_95C97EB130D0C16 ON vol');
        $this->addSql('ALTER TABLE vol DROP airline_id');
    }
}
