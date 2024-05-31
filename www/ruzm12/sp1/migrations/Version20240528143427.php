<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528143427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE football_match (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, played_at DATETIME NOT NULL, full_price DOUBLE PRECISION NOT NULL, child_price DOUBLE PRECISION NOT NULL, INDEX IDX_8CE33ACEB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, entrance_id INT NOT NULL, sold_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_multi TINYINT(1) NOT NULL, INDEX IDX_97A0ADA392458494 (entrance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_football_match (ticket_id INT NOT NULL, football_match_id INT NOT NULL, INDEX IDX_751B210D700047D2 (ticket_id), INDEX IDX_751B210DE1DA134D (football_match_id), PRIMARY KEY(ticket_id, football_match_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE football_match ADD CONSTRAINT FK_8CE33ACEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA392458494 FOREIGN KEY (entrance_id) REFERENCES entrance (id)');
        $this->addSql('ALTER TABLE ticket_football_match ADD CONSTRAINT FK_751B210D700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_football_match ADD CONSTRAINT FK_751B210DE1DA134D FOREIGN KEY (football_match_id) REFERENCES football_match (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE football_match DROP FOREIGN KEY FK_8CE33ACEB03A8386');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA392458494');
        $this->addSql('ALTER TABLE ticket_football_match DROP FOREIGN KEY FK_751B210D700047D2');
        $this->addSql('ALTER TABLE ticket_football_match DROP FOREIGN KEY FK_751B210DE1DA134D');
        $this->addSql('DROP TABLE entrance');
        $this->addSql('DROP TABLE football_match');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_football_match');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
