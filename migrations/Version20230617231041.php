<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617231041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_video_viewed (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_4F13C5CBA76ED395 (user_id), INDEX IDX_4F13C5CB29C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_video_likes (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_6FB38E4AA76ED395 (user_id), INDEX IDX_6FB38E4A29C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_video_view_later (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_73924F31A76ED395 (user_id), INDEX IDX_73924F3129C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_video_favorites (user_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_34CA71EFA76ED395 (user_id), INDEX IDX_34CA71EF29C1004E (video_id), PRIMARY KEY(user_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_video_viewed ADD CONSTRAINT FK_4F13C5CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_viewed ADD CONSTRAINT FK_4F13C5CB29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_likes ADD CONSTRAINT FK_6FB38E4AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_likes ADD CONSTRAINT FK_6FB38E4A29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_view_later ADD CONSTRAINT FK_73924F31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_view_later ADD CONSTRAINT FK_73924F3129C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_favorites ADD CONSTRAINT FK_34CA71EFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_favorites ADD CONSTRAINT FK_34CA71EF29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_tag DROP FOREIGN KEY FK_F910728729C1004E');
        $this->addSql('ALTER TABLE video_tag DROP FOREIGN KEY FK_F9107287BAD26311');
        $this->addSql('DROP TABLE video_tag');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE video_tag (video_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F910728729C1004E (video_id), INDEX IDX_F9107287BAD26311 (tag_id), PRIMARY KEY(video_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE video_tag ADD CONSTRAINT FK_F910728729C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_tag ADD CONSTRAINT FK_F9107287BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_viewed DROP FOREIGN KEY FK_4F13C5CBA76ED395');
        $this->addSql('ALTER TABLE user_video_viewed DROP FOREIGN KEY FK_4F13C5CB29C1004E');
        $this->addSql('ALTER TABLE user_video_likes DROP FOREIGN KEY FK_6FB38E4AA76ED395');
        $this->addSql('ALTER TABLE user_video_likes DROP FOREIGN KEY FK_6FB38E4A29C1004E');
        $this->addSql('ALTER TABLE user_video_view_later DROP FOREIGN KEY FK_73924F31A76ED395');
        $this->addSql('ALTER TABLE user_video_view_later DROP FOREIGN KEY FK_73924F3129C1004E');
        $this->addSql('ALTER TABLE user_video_favorites DROP FOREIGN KEY FK_34CA71EFA76ED395');
        $this->addSql('ALTER TABLE user_video_favorites DROP FOREIGN KEY FK_34CA71EF29C1004E');
        $this->addSql('DROP TABLE user_video_viewed');
        $this->addSql('DROP TABLE user_video_likes');
        $this->addSql('DROP TABLE user_video_view_later');
        $this->addSql('DROP TABLE user_video_favorites');
    }
}
