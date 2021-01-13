<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112215111 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test_karlhereford DROP FOREIGN KEY FK_108A96F8E161BAF2');
        $this->addSql('CREATE TABLE intereseskarlhereford (id INT AUTO_INCREMENT NOT NULL, interes VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testkarlhereford (id INT AUTO_INCREMENT NOT NULL, intereseskarlhereford_id INT NOT NULL, pregunta VARCHAR(80) NOT NULL, respuesta INT NOT NULL, INDEX IDX_3DCF7F88C7CE68F2 (intereseskarlhereford_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE testkarlhereford ADD CONSTRAINT FK_3DCF7F88C7CE68F2 FOREIGN KEY (intereseskarlhereford_id) REFERENCES intereseskarlhereford (id)');
        $this->addSql('DROP TABLE intereses_karlhereford');
        $this->addSql('DROP TABLE test_karlhereford');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE testkarlhereford DROP FOREIGN KEY FK_3DCF7F88C7CE68F2');
        $this->addSql('CREATE TABLE intereses_karlhereford (id INT AUTO_INCREMENT NOT NULL, interes VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE test_karlhereford (id INT AUTO_INCREMENT NOT NULL, intereses_karlhereford_id INT NOT NULL, pregunta VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci, respuesta INT NOT NULL, INDEX IDX_108A96F8E161BAF2 (intereses_karlhereford_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE test_karlhereford ADD CONSTRAINT FK_108A96F8E161BAF2 FOREIGN KEY (intereses_karlhereford_id) REFERENCES intereses_karlhereford (id)');
        $this->addSql('DROP TABLE intereseskarlhereford');
        $this->addSql('DROP TABLE testkarlhereford');
        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
    }
}
