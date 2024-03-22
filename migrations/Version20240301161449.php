<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301161449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_member ADD many_to_one_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE group_member ADD CONSTRAINT FK_A36222A8EAB5DEB FOREIGN KEY (many_to_one_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_A36222A8EAB5DEB ON group_member (many_to_one_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_member DROP FOREIGN KEY FK_A36222A8EAB5DEB');
        $this->addSql('DROP INDEX IDX_A36222A8EAB5DEB ON group_member');
        $this->addSql('ALTER TABLE group_member DROP many_to_one_id');
    }
}
