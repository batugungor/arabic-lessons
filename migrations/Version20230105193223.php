<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105193223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dialogue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dialogue_text (id INT AUTO_INCREMENT NOT NULL, dialogue_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_3155ABA6A6E12CBD (dialogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dialogue_text_words (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, text LONGTEXT NOT NULL, word_order INT NOT NULL, INDEX IDX_EA8DDE533256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dialogue_text ADD CONSTRAINT FK_3155ABA6A6E12CBD FOREIGN KEY (dialogue_id) REFERENCES dialogue (id)');
        $this->addSql('ALTER TABLE dialogue_text_words ADD CONSTRAINT FK_EA8DDE533256915B FOREIGN KEY (relation_id) REFERENCES dialogue_text (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialogue_text DROP FOREIGN KEY FK_3155ABA6A6E12CBD');
        $this->addSql('ALTER TABLE dialogue_text_words DROP FOREIGN KEY FK_EA8DDE533256915B');
        $this->addSql('DROP TABLE dialogue');
        $this->addSql('DROP TABLE dialogue_text');
        $this->addSql('DROP TABLE dialogue_text_words');
    }
}
