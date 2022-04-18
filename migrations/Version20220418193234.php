<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418193234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, raza_id INT DEFAULT NULL, espaciofisico_id INT DEFAULT NULL, nombre VARCHAR(60) NOT NULL, fechanac DATE NOT NULL, sexo VARCHAR(60) NOT NULL, peso INT NOT NULL, color VARCHAR(60) NOT NULL, chip VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, altura INT NOT NULL, fechaentrada DATE NOT NULL, INDEX IDX_6AAB231FA9276E6C (tipo_id), INDEX IDX_6AAB231F8CCBB6A9 (raza_id), INDEX IDX_6AAB231FE3407347 (espaciofisico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espacio_fisico (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raza (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarea (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramo (id INT AUTO_INCREMENT NOT NULL, tramo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FE3407347 FOREIGN KEY (espaciofisico_id) REFERENCES espacio_fisico (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FE3407347');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8CCBB6A9');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA9276E6C');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE espacio_fisico');
        $this->addSql('DROP TABLE raza');
        $this->addSql('DROP TABLE tarea');
        $this->addSql('DROP TABLE tipo');
        $this->addSql('DROP TABLE tramo');
    }
}
