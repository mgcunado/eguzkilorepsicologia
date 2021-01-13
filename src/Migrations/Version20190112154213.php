<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112154213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE test_karlhereford DROP FOREIGN KEY FK_108A96F85CFFA675');
        $this->addSql('DROP INDEX IDX_108A96F85CFFA675 ON test_karlhereford');
        $this->addSql('ALTER TABLE test_karlhereford CHANGE interes_id intereses_karlhereford_id INT NOT NULL');
        $this->addSql('ALTER TABLE test_karlhereford ADD CONSTRAINT FK_108A96F8E161BAF2 FOREIGN KEY (intereses_karlhereford_id) REFERENCES intereses_karlhereford (id)');
        $this->addSql('CREATE INDEX IDX_108A96F8E161BAF2 ON test_karlhereford (intereses_karlhereford_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE test_karlhereford DROP FOREIGN KEY FK_108A96F8E161BAF2');
        $this->addSql('DROP INDEX IDX_108A96F8E161BAF2 ON test_karlhereford');
        $this->addSql('ALTER TABLE test_karlhereford CHANGE intereses_karlhereford_id interes_id INT NOT NULL');
        $this->addSql('ALTER TABLE test_karlhereford ADD CONSTRAINT FK_108A96F85CFFA675 FOREIGN KEY (interes_id) REFERENCES intereses_karlhereford (id)');
        $this->addSql('CREATE INDEX IDX_108A96F85CFFA675 ON test_karlhereford (interes_id)');
    }
}
