<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190310082528 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorieprob DROP FOREIGN KEY FK_3F0B6C5918BBFAFB');
        $this->addSql('DROP INDEX IDX_3F0B6C5918BBFAFB ON categorieprob');
        $this->addSql('ALTER TABLE categorieprob DROP problematique_id');
        $this->addSql('ALTER TABLE problematique ADD categorieprob_id INT NOT NULL');
        $this->addSql('ALTER TABLE problematique ADD CONSTRAINT FK_10855AEE5BB62D13 FOREIGN KEY (categorieprob_id) REFERENCES categorieprob (id)');
        $this->addSql('CREATE INDEX IDX_10855AEE5BB62D13 ON problematique (categorieprob_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorieprob ADD problematique_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorieprob ADD CONSTRAINT FK_3F0B6C5918BBFAFB FOREIGN KEY (problematique_id) REFERENCES problematique (id)');
        $this->addSql('CREATE INDEX IDX_3F0B6C5918BBFAFB ON categorieprob (problematique_id)');
        $this->addSql('ALTER TABLE problematique DROP FOREIGN KEY FK_10855AEE5BB62D13');
        $this->addSql('DROP INDEX IDX_10855AEE5BB62D13 ON problematique');
        $this->addSql('ALTER TABLE problematique DROP categorieprob_id');
    }
}
