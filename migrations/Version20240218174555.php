<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218174555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registre_comment (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, agent VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D9CB5C5B727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registre_comment ADD CONSTRAINT FK_D9CB5C5B727ACA70 FOREIGN KEY (parent_id) REFERENCES registre (id)');
        $this->addSql('ALTER TABLE registre_category_registre DROP FOREIGN KEY FK_634575F1E14FFAA');
        $this->addSql('ALTER TABLE registre_category_registre DROP FOREIGN KEY FK_634575F5678EFCA');
        $this->addSql('DROP TABLE registre_category_registre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registre_category_registre (registre_category_id INT NOT NULL, registre_id INT NOT NULL, INDEX IDX_634575F1E14FFAA (registre_category_id), INDEX IDX_634575F5678EFCA (registre_id), PRIMARY KEY(registre_category_id, registre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE registre_category_registre ADD CONSTRAINT FK_634575F1E14FFAA FOREIGN KEY (registre_category_id) REFERENCES registre_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_category_registre ADD CONSTRAINT FK_634575F5678EFCA FOREIGN KEY (registre_id) REFERENCES registre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_comment DROP FOREIGN KEY FK_D9CB5C5B727ACA70');
        $this->addSql('DROP TABLE registre_comment');
    }
}
