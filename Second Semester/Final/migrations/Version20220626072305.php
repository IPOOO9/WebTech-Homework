<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626072305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aces (id INT AUTO_INCREMENT NOT NULL, ace_name VARCHAR(255) NOT NULL, callsign VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aces_aircraft (aces_id INT NOT NULL, aircraft_id INT NOT NULL, INDEX IDX_6430C9A78F950EB6 (aces_id), INDEX IDX_6430C9A7846E2F5C (aircraft_id), PRIMARY KEY(aces_id, aircraft_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battles (id INT AUTO_INCREMENT NOT NULL, battle_place_id INT NOT NULL, battle_name VARCHAR(255) NOT NULL, INDEX IDX_3AA9A2A9D9D70D4F (battle_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battles_aces (battles_id INT NOT NULL, aces_id INT NOT NULL, INDEX IDX_DB9618383D366C2 (battles_id), INDEX IDX_DB961838F950EB6 (aces_id), PRIMARY KEY(battles_id, aces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, place_name VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aces_aircraft ADD CONSTRAINT FK_6430C9A78F950EB6 FOREIGN KEY (aces_id) REFERENCES aces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aces_aircraft ADD CONSTRAINT FK_6430C9A7846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircraft (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE battles ADD CONSTRAINT FK_3AA9A2A9D9D70D4F FOREIGN KEY (battle_place_id) REFERENCES places (id)');
        $this->addSql('ALTER TABLE battles_aces ADD CONSTRAINT FK_DB9618383D366C2 FOREIGN KEY (battles_id) REFERENCES battles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE battles_aces ADD CONSTRAINT FK_DB961838F950EB6 FOREIGN KEY (aces_id) REFERENCES aces (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aces_aircraft DROP FOREIGN KEY FK_6430C9A78F950EB6');
        $this->addSql('ALTER TABLE battles_aces DROP FOREIGN KEY FK_DB961838F950EB6');
        $this->addSql('ALTER TABLE battles_aces DROP FOREIGN KEY FK_DB9618383D366C2');
        $this->addSql('ALTER TABLE battles DROP FOREIGN KEY FK_3AA9A2A9D9D70D4F');
        $this->addSql('DROP TABLE aces');
        $this->addSql('DROP TABLE aces_aircraft');
        $this->addSql('DROP TABLE battles');
        $this->addSql('DROP TABLE battles_aces');
        $this->addSql('DROP TABLE places');
    }
}
