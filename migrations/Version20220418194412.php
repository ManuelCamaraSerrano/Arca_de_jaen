<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418194412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopcion (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, fecha DATE NOT NULL, contrato VARCHAR(255) DEFAULT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_2010D98FDB38439E (usuario_id), INDEX IDX_2010D98F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_perdido (id INT AUTO_INCREMENT NOT NULL, raza_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, tipo_id INT DEFAULT NULL, nombre VARCHAR(60) NOT NULL, color VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, INDEX IDX_A2E0FB88CCBB6A9 (raza_id), INDEX IDX_A2E0FB8DB38439E (usuario_id), INDEX IDX_A2E0FB8A9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cita (id INT AUTO_INCREMENT NOT NULL, solicitud_id INT DEFAULT NULL, fecha DATE NOT NULL, hora TIME NOT NULL, INDEX IDX_3E379A621CB9D6E4 (solicitud_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fotos (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, foto VARCHAR(255) NOT NULL, INDEX IDX_CB8405C78E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, tarea_id INT DEFAULT NULL, tramo_id INT DEFAULT NULL, fecha DATE NOT NULL, INDEX IDX_188D2E3BDB38439E (usuario_id), INDEX IDX_188D2E3B6D5BDFE1 (tarea_id), INDEX IDX_188D2E3B6E801575 (tramo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solicitud (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, fecha DATE NOT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_96D27CC0DB38439E (usuario_id), INDEX IDX_96D27CC08E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopcion ADD CONSTRAINT FK_2010D98FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE adopcion ADD CONSTRAINT FK_2010D98F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE animal_perdido ADD CONSTRAINT FK_A2E0FB88CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE animal_perdido ADD CONSTRAINT FK_A2E0FB8DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE animal_perdido ADD CONSTRAINT FK_A2E0FB8A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A621CB9D6E4 FOREIGN KEY (solicitud_id) REFERENCES solicitud (id)');
        $this->addSql('ALTER TABLE fotos ADD CONSTRAINT FK_CB8405C78E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B6D5BDFE1 FOREIGN KEY (tarea_id) REFERENCES tarea (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B6E801575 FOREIGN KEY (tramo_id) REFERENCES tramo (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC08E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A621CB9D6E4');
        $this->addSql('DROP TABLE adopcion');
        $this->addSql('DROP TABLE animal_perdido');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE fotos');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE solicitud');
    }
}
