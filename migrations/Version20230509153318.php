<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509153318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin ADD guest_name VARCHAR(255) NOT NULL, ADD guest_surname VARCHAR(255) NOT NULL, ADD guest_tel INT NOT NULL, DROP guest_id, DROP room_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE checkin ADD room_id INT NOT NULL, DROP guest_name, DROP guest_surname, CHANGE guest_tel guest_id INT NOT NULL');
    }
}
