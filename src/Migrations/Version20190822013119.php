<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190822013119 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(100) NOT NULL, imgorder INT NOT NULL, imgorderrand INT NOT NULL, incluido VARCHAR(2) NOT NULL, tipo VARCHAR(60) NOT NULL, created DATETIME NOT NULL, modified DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE gastos');
        $this->addSql('DROP TABLE ingresos');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clientes CHANGE email email VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE facturas CHANGE modopago modopago VARCHAR(50) DEFAULT \'Metálico\' NOT NULL, CHANGE cobrado cobrado VARCHAR(2) DEFAULT \'si\' NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gastos (id INT UNSIGNED AUTO_INCREMENT NOT NULL, concepto VARCHAR(80) NOT NULL COLLATE utf8_unicode_ci, importe NUMERIC(6, 2) DEFAULT \'0.00\' NOT NULL, iva INT DEFAULT 21 NOT NULL, mod300 VARCHAR(80) DEFAULT \'\'2T\'\' NOT NULL COLLATE latin1_swedish_ci, fechacompra DATE DEFAULT \'\'0000-00-00\'\' NOT NULL, formadepago VARCHAR(80) DEFAULT \'\'tarjeta\'\' NOT NULL COLLATE utf8_unicode_ci, faltafactura VARCHAR(2) DEFAULT \'\'no\'\' NOT NULL COLLATE latin1_swedish_ci, realizado VARCHAR(80) DEFAULT \'\'realizado\'\' NOT NULL COLLATE latin1_swedish_ci, numerofactura INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ingresos (id INT UNSIGNED AUTO_INCREMENT NOT NULL, concepto VARCHAR(80) NOT NULL COLLATE utf8_unicode_ci, importe NUMERIC(6, 2) DEFAULT \'0.00\' NOT NULL, iva INT DEFAULT 21 NOT NULL, mod300 VARCHAR(80) DEFAULT \'\'2T\'\' NOT NULL COLLATE utf8mb4_unicode_ci, fechaingreso DATE DEFAULT \'\'0000-00-00\'\' NOT NULL, formadepago VARCHAR(80) DEFAULT \'\'efectivo\'\' NOT NULL COLLATE utf8_unicode_ci, faltafactura VARCHAR(2) DEFAULT \'\'no\'\' NOT NULL COLLATE utf8mb4_unicode_ci, realizado VARCHAR(80) DEFAULT \'\'realizado\'\' NOT NULL COLLATE utf8mb4_unicode_ci, numerofactura INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE images');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clientes CHANGE email email VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE facturas CHANGE modopago modopago VARCHAR(50) DEFAULT \'\'Metálico\'\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cobrado cobrado VARCHAR(2) DEFAULT \'\'si\'\' NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
