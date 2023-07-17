<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105193458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialogue ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dialogue_text ADD dialogue_order INT NOT NULL');
        $this->addSql('ALTER TABLE dialogue_text_words DROP FOREIGN KEY FK_EA8DDE533256915B');
        $this->addSql('DROP INDEX IDX_EA8DDE533256915B ON dialogue_text_words');
        $this->addSql('ALTER TABLE dialogue_text_words CHANGE relation_id dialogue_text_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dialogue_text_words ADD CONSTRAINT FK_EA8DDE53ED46248A FOREIGN KEY (dialogue_text_id) REFERENCES dialogue_text (id)');
        $this->addSql('CREATE INDEX IDX_EA8DDE53ED46248A ON dialogue_text_words (dialogue_text_id)');
        $this->addSql('ALTER TABLE page ADD dialogue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620A6E12CBD FOREIGN KEY (dialogue_id) REFERENCES dialogue (id)');
        $this->addSql('CREATE INDEX IDX_140AB620A6E12CBD ON page (dialogue_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialogue DROP title');
        $this->addSql('ALTER TABLE dialogue_text DROP dialogue_order');
        $this->addSql('ALTER TABLE dialogue_text_words DROP FOREIGN KEY FK_EA8DDE53ED46248A');
        $this->addSql('DROP INDEX IDX_EA8DDE53ED46248A ON dialogue_text_words');
        $this->addSql('ALTER TABLE dialogue_text_words CHANGE dialogue_text_id relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dialogue_text_words ADD CONSTRAINT FK_EA8DDE533256915B FOREIGN KEY (relation_id) REFERENCES dialogue_text (id)');
        $this->addSql('CREATE INDEX IDX_EA8DDE533256915B ON dialogue_text_words (relation_id)');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620A6E12CBD');
        $this->addSql('DROP INDEX IDX_140AB620A6E12CBD ON page');
        $this->addSql('ALTER TABLE page DROP dialogue_id');
    }
}
