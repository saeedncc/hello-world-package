<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607113855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, truck_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(80) NOT NULL, INDEX IDX_7656F53BC3423909 (driver_id), INDEX IDX_7656F53BC6957CCE (truck_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        // $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        // $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC6957CCE');
        $this->addSql('DROP TABLE trip');
    }
}
