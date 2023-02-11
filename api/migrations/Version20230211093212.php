<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211093212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `score_users` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, phone_score INT DEFAULT NULL, email_score INT DEFAULT NULL, education_score INT NOT NULL, agreement_score INT DEFAULT NULL, total_score INT NOT NULL, INDEX IDX_ADCF6961A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `score_users` ADD CONSTRAINT FK_ADCF6961A76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE users ADD score_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E912EB0A51 FOREIGN KEY (score_id) REFERENCES `score_users` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E912EB0A51 ON users (score_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `users` DROP FOREIGN KEY FK_1483A5E912EB0A51');
        $this->addSql('ALTER TABLE `score_users` DROP FOREIGN KEY FK_ADCF6961A76ED395');
        $this->addSql('DROP TABLE `score_users`');
        $this->addSql('DROP INDEX UNIQ_1483A5E912EB0A51 ON `users`');
        $this->addSql('ALTER TABLE `users` DROP score_id');
    }
}
