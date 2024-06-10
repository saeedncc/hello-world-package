<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607135840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, trip_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(80) NOT NULL, INDEX IDX_527EDB25A5BC2E0E (trip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        // $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        // $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A5BC2E0E');
        $this->addSql('DROP TABLE task');
        // $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        // $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC6957CCE');
    }
}
