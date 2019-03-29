<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106150354 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorieprob ADD problematique_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorieprob ADD CONSTRAINT FK_3F0B6C5918BBFAFB FOREIGN KEY (problematique_id) REFERENCES problematique (id)');
        $this->addSql('CREATE INDEX IDX_3F0B6C5918BBFAFB ON categorieprob (problematique_id)');
        $this->addSql('ALTER TABLE messagepublic ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE messagepublic ADD CONSTRAINT FK_4E2A3D6A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4E2A3D6A67B3B43D ON messagepublic (users_id)');
        $this->addSql('ALTER TABLE notification ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA67B3B43D ON notification (users_id)');
        $this->addSql('ALTER TABLE users ADD problematique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E918BBFAFB FOREIGN KEY (problematique_id) REFERENCES problematique (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E918BBFAFB ON users (problematique_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorieprob DROP FOREIGN KEY FK_3F0B6C5918BBFAFB');
        $this->addSql('DROP INDEX IDX_3F0B6C5918BBFAFB ON categorieprob');
        $this->addSql('ALTER TABLE categorieprob DROP problematique_id');
        $this->addSql('ALTER TABLE messagepublic DROP FOREIGN KEY FK_4E2A3D6A67B3B43D');
        $this->addSql('DROP INDEX IDX_4E2A3D6A67B3B43D ON messagepublic');
        $this->addSql('ALTER TABLE messagepublic DROP users_id');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA67B3B43D');
        $this->addSql('DROP INDEX IDX_BF5476CA67B3B43D ON notification');
        $this->addSql('ALTER TABLE notification DROP users_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E918BBFAFB');
        $this->addSql('DROP INDEX UNIQ_1483A5E918BBFAFB ON users');
        $this->addSql('ALTER TABLE users DROP problematique_id');
    }
}
