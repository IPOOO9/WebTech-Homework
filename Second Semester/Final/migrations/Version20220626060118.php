<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626060118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aircraft (id INT AUTO_INCREMENT NOT NULL, nation_manufacturer_id INT NOT NULL, model VARCHAR(100) NOT NULL, INDEX IDX_13D96729516FFB67 (nation_manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nations (id INT AUTO_INCREMENT NOT NULL, nation_name VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D96729516FFB67 FOREIGN KEY (nation_manufacturer_id) REFERENCES nations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D96729516FFB67');
        $this->addSql('DROP TABLE aircraft');
        $this->addSql('DROP TABLE nations');
    }
}
