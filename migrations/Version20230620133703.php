<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620133703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_video_viewed DROP FOREIGN KEY FK_4F13C5CB29C1004E');
        $this->addSql('ALTER TABLE user_video_viewed DROP FOREIGN KEY FK_4F13C5CBA76ED395');
        $this->addSql('DROP TABLE user_video_viewed');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_video_viewed (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_4F13C5CBA76ED395 (user_id), INDEX IDX_4F13C5CB29C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_video_viewed ADD CONSTRAINT FK_4F13C5CB29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_viewed ADD CONSTRAINT FK_4F13C5CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
