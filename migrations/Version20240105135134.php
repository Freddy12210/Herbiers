<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105135134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE releves ADD lieu_id INT DEFAULT NULL, DROP lieu');
        $this->addSql('ALTER TABLE releves ADD CONSTRAINT FK_6F62B66E6AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_6F62B66E6AB213CC ON releves (lieu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE releves DROP FOREIGN KEY FK_6F62B66E6AB213CC');
        $this->addSql('DROP INDEX IDX_6F62B66E6AB213CC ON releves');
        $this->addSql('ALTER TABLE releves ADD lieu VARCHAR(255) NOT NULL, DROP lieu_id');
    }
}
