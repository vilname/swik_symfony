<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208135611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `type_phone` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `type_phone_code` (id INT AUTO_INCREMENT NOT NULL, type_phone_id INT DEFAULT NULL, code INT NOT NULL, INDEX IDX_8912B4AFF68C0437 (type_phone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, phone_type INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, type_education ENUM(\'visible\', \'invisible\'), agreement TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `type_phone_code` ADD CONSTRAINT FK_8912B4AFF68C0437 FOREIGN KEY (type_phone_id) REFERENCES `type_phone` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `type_phone_code` DROP FOREIGN KEY FK_8912B4AFF68C0437');
        $this->addSql('DROP TABLE `type_phone`');
        $this->addSql('DROP TABLE `type_phone_code`');
        $this->addSql('DROP TABLE `user`');
    }
}
