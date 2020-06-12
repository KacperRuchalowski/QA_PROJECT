<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200607193713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_datas ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE users_datas ADD CONSTRAINT FK_AEF3278467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEF3278467B3B43D ON users_datas (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Users_datas DROP FOREIGN KEY FK_AEF3278467B3B43D');
        $this->addSql('DROP INDEX UNIQ_AEF3278467B3B43D ON Users_datas');
        $this->addSql('ALTER TABLE Users_datas DROP users_id');
    }
}
