<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209211717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `score_rules` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type ENUM(\'phone\', \'email\', \'education\', \'agreement\'), value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `type_educations` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, education_type_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, agreement TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9D968E34B (education_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT FK_1483A5E9D968E34B FOREIGN KEY (education_type_id) REFERENCES `type_educations` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `users` DROP FOREIGN KEY FK_1483A5E9D968E34B');
        $this->addSql('DROP TABLE `score_rules`');
        $this->addSql('DROP TABLE `type_educations`');
        $this->addSql('DROP TABLE `users`');
    }
}
