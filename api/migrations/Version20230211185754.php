<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211185754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_users DROP INDEX IDX_ADCF6961A76ED395, ADD UNIQUE INDEX UNIQ_ADCF6961A76ED395 (user_id)');
        $this->addSql('ALTER TABLE score_users DROP FOREIGN KEY FK_ADCF6961A76ED395');
        $this->addSql('ALTER TABLE score_users ADD CONSTRAINT FK_ADCF6961A76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `score_users` DROP INDEX UNIQ_ADCF6961A76ED395, ADD INDEX IDX_ADCF6961A76ED395 (user_id)');
        $this->addSql('ALTER TABLE `score_users` DROP FOREIGN KEY FK_ADCF6961A76ED395');
        $this->addSql('ALTER TABLE `score_users` ADD CONSTRAINT FK_ADCF6961A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
