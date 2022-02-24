<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204150503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY articles_ibfk_1');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY articles_ibfk_2');
        $this->addSql('DROP INDEX id_categorie ON articles');
        $this->addSql('DROP INDEX id_console ON articles');
        $this->addSql('ALTER TABLE articles CHANGE id_categorie id_categorie VARCHAR(255) NOT NULL, CHANGE id_console id_console VARCHAR(255) NOT NULL, CHANGE title title VARCHAR(1000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles CHANGE title title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE id_categorie id_categorie INT NOT NULL, CHANGE id_console id_console INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT articles_ibfk_1 FOREIGN KEY (id_categorie) REFERENCES categorie (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT articles_ibfk_2 FOREIGN KEY (id_console) REFERENCES console (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_categorie ON articles (id_categorie)');
        $this->addSql('CREATE INDEX id_console ON articles (id_console)');
    }
}
