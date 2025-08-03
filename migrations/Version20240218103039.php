<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218103039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registre_registre_status (registre_id INT NOT NULL, registre_status_id INT NOT NULL, INDEX IDX_E2A7161D5678EFCA (registre_id), INDEX IDX_E2A7161D1C48C031 (registre_status_id), PRIMARY KEY(registre_id, registre_status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registre_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registre_registre_status ADD CONSTRAINT FK_E2A7161D5678EFCA FOREIGN KEY (registre_id) REFERENCES registre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_registre_status ADD CONSTRAINT FK_E2A7161D1C48C031 FOREIGN KEY (registre_status_id) REFERENCES registre_status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_category_registre DROP FOREIGN KEY FK_634575F1E14FFAA');
        $this->addSql('ALTER TABLE registre_category_registre DROP FOREIGN KEY FK_634575F5678EFCA');
        $this->addSql('DROP TABLE registre_category_registre');
        $this->addSql('ALTER TABLE registre DROP status');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registre_category_registre (registre_category_id INT NOT NULL, registre_id INT NOT NULL, INDEX IDX_634575F5678EFCA (registre_id), INDEX IDX_634575F1E14FFAA (registre_category_id), PRIMARY KEY(registre_category_id, registre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE registre_category_registre ADD CONSTRAINT FK_634575F1E14FFAA FOREIGN KEY (registre_category_id) REFERENCES registre_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_category_registre ADD CONSTRAINT FK_634575F5678EFCA FOREIGN KEY (registre_id) REFERENCES registre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_registre_status DROP FOREIGN KEY FK_E2A7161D5678EFCA');
        $this->addSql('ALTER TABLE registre_registre_status DROP FOREIGN KEY FK_E2A7161D1C48C031');
        $this->addSql('DROP TABLE registre_registre_status');
        $this->addSql('DROP TABLE registre_status');
        $this->addSql('ALTER TABLE registre ADD status VARCHAR(255) DEFAULT NULL');
    }
}
