<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190504102354 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aeroportinternationnal (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_B1CDA131A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_user (id INT AUTO_INCREMENT NOT NULL, avis_id INT NOT NULL, INDEX IDX_42223E48197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nombre_de_kilo_restant (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, libelle DOUBLE PRECISION NOT NULL, INDEX IDX_4125B2F78805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_postulant_une_annonce (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, users_id INT NOT NULL, nombre_kilo DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_EB7E99B98805AB2F (annonce_id), INDEX IDX_EB7E99B967B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville_annonce (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, ville_id INT NOT NULL, INDEX IDX_C0403A598805AB2F (annonce_id), INDEX IDX_C0403A59A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aeroportinternationnal ADD CONSTRAINT FK_B1CDA131A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE avis_user ADD CONSTRAINT FK_42223E48197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE nombre_de_kilo_restant ADD CONSTRAINT FK_4125B2F78805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE personne_postulant_une_annonce ADD CONSTRAINT FK_EB7E99B98805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE personne_postulant_une_annonce ADD CONSTRAINT FK_EB7E99B967B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ville_annonce ADD CONSTRAINT FK_C0403A598805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE ville_annonce ADD CONSTRAINT FK_C0403A59A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE annonce ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_F65593E567B3B43D ON annonce (users_id)');
        $this->addSql('ALTER TABLE avis ADD annonce_id INT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF08805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF08805AB2F ON avis (annonce_id)');
        $this->addSql('ALTER TABLE ville ADD pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C3A6E44244 ON ville (pays_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aeroportinternationnal');
        $this->addSql('DROP TABLE avis_user');
        $this->addSql('DROP TABLE nombre_de_kilo_restant');
        $this->addSql('DROP TABLE personne_postulant_une_annonce');
        $this->addSql('DROP TABLE ville_annonce');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E567B3B43D');
        $this->addSql('DROP INDEX IDX_F65593E567B3B43D ON annonce');
        $this->addSql('ALTER TABLE annonce DROP users_id');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF08805AB2F');
        $this->addSql('DROP INDEX IDX_8F91ABF08805AB2F ON avis');
        $this->addSql('ALTER TABLE avis DROP annonce_id');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
        $this->addSql('DROP INDEX IDX_43C3D9C3A6E44244 ON ville');
        $this->addSql('ALTER TABLE ville DROP pays_id');
    }
}
