<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620134204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE viewed (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, video_id INT DEFAULT NULL, INDEX IDX_F7881904A76ED395 (user_id), INDEX IDX_F788190429C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE viewed ADD CONSTRAINT FK_F7881904A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE viewed ADD CONSTRAINT FK_F788190429C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE viewed DROP FOREIGN KEY FK_F7881904A76ED395');
        $this->addSql('ALTER TABLE viewed DROP FOREIGN KEY FK_F788190429C1004E');
        $this->addSql('DROP TABLE viewed');
    }
}
