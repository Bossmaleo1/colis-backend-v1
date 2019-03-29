<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190309120349 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE messagepublic ADD problematique_id INT NOT NULL');
        $this->addSql('ALTER TABLE messagepublic ADD CONSTRAINT FK_4E2A3D6A18BBFAFB FOREIGN KEY (problematique_id) REFERENCES problematique (id)');
        $this->addSql('CREATE INDEX IDX_4E2A3D6A18BBFAFB ON messagepublic (problematique_id)');
        $this->addSql('ALTER TABLE photo_messagepublic ADD extension VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE messagepublic DROP FOREIGN KEY FK_4E2A3D6A18BBFAFB');
        $this->addSql('DROP INDEX IDX_4E2A3D6A18BBFAFB ON messagepublic');
        $this->addSql('ALTER TABLE messagepublic DROP problematique_id');
        $this->addSql('ALTER TABLE photo_messagepublic DROP extension');
    }
}
