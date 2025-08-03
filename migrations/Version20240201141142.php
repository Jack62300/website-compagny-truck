<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201141142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE procedure_procedure_type DROP FOREIGN KEY FK_AEBFAFCE1624BCD2');
        $this->addSql('ALTER TABLE procedure_procedure_type DROP FOREIGN KEY FK_AEBFAFCE9404667A');
        $this->addSql('ALTER TABLE procedure_type_procedure_sous_type DROP FOREIGN KEY FK_CDA2F7349404667A');
        $this->addSql('ALTER TABLE procedure_type_procedure_sous_type DROP FOREIGN KEY FK_CDA2F734A76A4041');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE procedure_procedure_type');
        $this->addSql('DROP TABLE procedure_sous_type');
        $this->addSql('DROP TABLE procedure_type');
        $this->addSql('DROP TABLE procedure_type_procedure_sous_type');
        $this->addSql('ALTER TABLE `procedure` ADD image_size INT DEFAULT NULL, CHANGE image image_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, agent VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaire LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, color_bg VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE procedure_procedure_type (procedure_id INT NOT NULL, procedure_type_id INT NOT NULL, INDEX IDX_AEBFAFCE9404667A (procedure_type_id), INDEX IDX_AEBFAFCE1624BCD2 (procedure_id), PRIMARY KEY(procedure_id, procedure_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE procedure_sous_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, agent VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE procedure_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE procedure_type_procedure_sous_type (procedure_type_id INT NOT NULL, procedure_sous_type_id INT NOT NULL, INDEX IDX_CDA2F734A76A4041 (procedure_sous_type_id), INDEX IDX_CDA2F7349404667A (procedure_type_id), PRIMARY KEY(procedure_type_id, procedure_sous_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE procedure_procedure_type ADD CONSTRAINT FK_AEBFAFCE1624BCD2 FOREIGN KEY (procedure_id) REFERENCES `procedure` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_procedure_type ADD CONSTRAINT FK_AEBFAFCE9404667A FOREIGN KEY (procedure_type_id) REFERENCES procedure_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_type_procedure_sous_type ADD CONSTRAINT FK_CDA2F7349404667A FOREIGN KEY (procedure_type_id) REFERENCES procedure_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_type_procedure_sous_type ADD CONSTRAINT FK_CDA2F734A76A4041 FOREIGN KEY (procedure_sous_type_id) REFERENCES procedure_sous_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `procedure` DROP image_size, CHANGE image_name image VARCHAR(255) DEFAULT NULL');
    }
}
