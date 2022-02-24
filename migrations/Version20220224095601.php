<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224095601 extends AbstractMigration
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
        $this->addSql('ALTER TABLE articles CHANGE title title VARCHAR(1000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles CHANGE title title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT articles_ibfk_1 FOREIGN KEY (idcategorie) REFERENCES categorie (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT articles_ibfk_2 FOREIGN KEY (idconsole) REFERENCES console (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_categorie ON articles (idcategorie)');
        $this->addSql('CREATE INDEX id_console ON articles (idconsole)');
    }
}
