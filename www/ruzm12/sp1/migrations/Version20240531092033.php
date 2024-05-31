<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531092033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_football_match DROP FOREIGN KEY FK_751B210D700047D2');
        $this->addSql('ALTER TABLE ticket_football_match DROP FOREIGN KEY FK_751B210DE1DA134D');
        $this->addSql('DROP TABLE ticket_football_match');
        $this->addSql('ALTER TABLE ticket ADD football_match_id INT NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E1DA134D FOREIGN KEY (football_match_id) REFERENCES football_match (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA37E3C61F9 ON ticket (owner_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3E1DA134D ON ticket (football_match_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_football_match (ticket_id INT NOT NULL, football_match_id INT NOT NULL, INDEX IDX_751B210D700047D2 (ticket_id), INDEX IDX_751B210DE1DA134D (football_match_id), PRIMARY KEY(ticket_id, football_match_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ticket_football_match ADD CONSTRAINT FK_751B210D700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_football_match ADD CONSTRAINT FK_751B210DE1DA134D FOREIGN KEY (football_match_id) REFERENCES football_match (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37E3C61F9');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E1DA134D');
        $this->addSql('DROP INDEX IDX_97A0ADA37E3C61F9 ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA3E1DA134D ON ticket');
        $this->addSql('ALTER TABLE ticket DROP football_match_id');
    }
}
