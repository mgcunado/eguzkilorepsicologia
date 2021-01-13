<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191022205524 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clientes CHANGE email email VARCHAR(60) DEFAULT NULL, CHANGE telefono telefono VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE facturas CHANGE modopago modopago VARCHAR(50) DEFAULT \'Metálico\' NOT NULL, CHANGE cobrado cobrado VARCHAR(2) DEFAULT \'si\' NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clientes CHANGE telefono telefono VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE facturas CHANGE modopago modopago VARCHAR(50) DEFAULT \'\'Metálico\'\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cobrado cobrado VARCHAR(2) DEFAULT \'\'si\'\' NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
