<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510175031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin CHANGE rate price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE room CHANGE rate price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE type CHANGE rate price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type CHANGE price rate DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE checkin CHANGE price rate DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE room CHANGE price rate DOUBLE PRECISION NOT NULL');
    }
}
