<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307234832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registre_registre_category DROP FOREIGN KEY FK_D65B91A11E14FFAA');
        $this->addSql('ALTER TABLE registre_registre_category DROP FOREIGN KEY FK_D65B91A15678EFCA');
        $this->addSql('DROP TABLE registre_category');
        $this->addSql('DROP TABLE registre_registre_category');
        $this->addSql('ALTER TABLE personelle DROP FOREIGN KEY FK_56C785F4545317D1');
        $this->addSql('DROP INDEX UNIQ_56C785F4545317D1 ON personelle');
        $this->addSql('ALTER TABLE personelle DROP vehicle_id');
        $this->addSql('ALTER TABLE vehicule_personelle DROP FOREIGN KEY FK_AD81F5B71179CD6');
        $this->addSql('DROP INDEX UNIQ_AD81F5B71179CD6 ON vehicule_personelle');
        $this->addSql('ALTER TABLE vehicule_personelle CHANGE name_id personelle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule_personelle ADD CONSTRAINT FK_AD81F5B97782577 FOREIGN KEY (personelle_id) REFERENCES personelle (id)');
        $this->addSql('CREATE INDEX IDX_AD81F5B97782577 ON vehicule_personelle (personelle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registre_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, icon VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE registre_registre_category (registre_id INT NOT NULL, registre_category_id INT NOT NULL, INDEX IDX_D65B91A15678EFCA (registre_id), INDEX IDX_D65B91A11E14FFAA (registre_category_id), PRIMARY KEY(registre_id, registre_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE registre_registre_category ADD CONSTRAINT FK_D65B91A11E14FFAA FOREIGN KEY (registre_category_id) REFERENCES registre_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registre_registre_category ADD CONSTRAINT FK_D65B91A15678EFCA FOREIGN KEY (registre_id) REFERENCES registre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personelle ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personelle ADD CONSTRAINT FK_56C785F4545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicule_personelle (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56C785F4545317D1 ON personelle (vehicle_id)');
        $this->addSql('ALTER TABLE vehicule_personelle DROP FOREIGN KEY FK_AD81F5B97782577');
        $this->addSql('DROP INDEX IDX_AD81F5B97782577 ON vehicule_personelle');
        $this->addSql('ALTER TABLE vehicule_personelle CHANGE personelle_id name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule_personelle ADD CONSTRAINT FK_AD81F5B71179CD6 FOREIGN KEY (name_id) REFERENCES personelle (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD81F5B71179CD6 ON vehicule_personelle (name_id)');
    }
}
