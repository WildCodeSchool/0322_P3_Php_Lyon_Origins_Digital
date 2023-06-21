<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230618092515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_tag (video_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F910728729C1004E (video_id), INDEX IDX_F9107287BAD26311 (tag_id), PRIMARY KEY(video_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_tag ADD CONSTRAINT FK_F910728729C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_tag ADD CONSTRAINT FK_F9107287BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_tag DROP FOREIGN KEY FK_F910728729C1004E');
        $this->addSql('ALTER TABLE video_tag DROP FOREIGN KEY FK_F9107287BAD26311');
        $this->addSql('DROP TABLE video_tag');
    }
}
