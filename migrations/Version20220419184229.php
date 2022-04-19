<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419184229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoption (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, adoption_date DATE NOT NULL, contract VARCHAR(255) DEFAULT NULL, state VARCHAR(255) NOT NULL, INDEX IDX_EDDEB6A9DB38439E (usuario_id), INDEX IDX_EDDEB6A98E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, request_id INT DEFAULT NULL, date DATE NOT NULL, hour TIME NOT NULL, INDEX IDX_FE38F844427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lost_animal (id INT AUTO_INCREMENT NOT NULL, race_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, type_id INT DEFAULT NULL, name VARCHAR(60) NOT NULL, colour VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_FE6591766E59D40D (race_id), INDEX IDX_FE659176DB38439E (usuario_id), INDEX IDX_FE659176C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_14B784188E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, date DATE NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_3B978F9FDB38439E (usuario_id), INDEX IDX_3B978F9F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserve (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, job_id INT DEFAULT NULL, stretch_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_1FE0EA22DB38439E (usuario_id), INDEX IDX_1FE0EA22BE04EA9 (job_id), INDEX IDX_1FE0EA224DF3B01F (stretch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adoption ADD CONSTRAINT FK_EDDEB6A9DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE adoption ADD CONSTRAINT FK_EDDEB6A98E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('ALTER TABLE lost_animal ADD CONSTRAINT FK_FE6591766E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE lost_animal ADD CONSTRAINT FK_FE659176DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE lost_animal ADD CONSTRAINT FK_FE659176C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE reserve ADD CONSTRAINT FK_1FE0EA22DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserve ADD CONSTRAINT FK_1FE0EA22BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE reserve ADD CONSTRAINT FK_1FE0EA224DF3B01F FOREIGN KEY (stretch_id) REFERENCES stretch (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844427EB8A5');
        $this->addSql('DROP TABLE adoption');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE lost_animal');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE reserve');
    }
}
