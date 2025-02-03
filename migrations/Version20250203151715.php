<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203151715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADB6CC67E');
        $this->addSql('DROP INDEX IDX_D34A04ADB6CC67E ON product');
        $this->addSql('ALTER TABLE product DROP name_key_id');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD name_key_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB6CC67E FOREIGN KEY (name_key_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADB6CC67E ON product (name_key_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP role, CHANGE telephone telephone INT NOT NULL');
    }
}
