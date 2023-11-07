<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107103203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE outside ADD campus_id INT NOT NULL, ADD statut_id INT NOT NULL, ADD place_id INT NOT NULL, ADD promoter_id INT NOT NULL');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA64B84B276 FOREIGN KEY (promoter_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_B5EAFDA6AF5D55E1 ON outside (campus_id)');
        $this->addSql('CREATE INDEX IDX_B5EAFDA6F6203804 ON outside (statut_id)');
        $this->addSql('CREATE INDEX IDX_B5EAFDA6DA6A219 ON outside (place_id)');
        $this->addSql('CREATE INDEX IDX_B5EAFDA64B84B276 ON outside (promoter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6AF5D55E1');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6F6203804');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6DA6A219');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA64B84B276');
        $this->addSql('DROP INDEX IDX_B5EAFDA6AF5D55E1 ON outside');
        $this->addSql('DROP INDEX IDX_B5EAFDA6F6203804 ON outside');
        $this->addSql('DROP INDEX IDX_B5EAFDA6DA6A219 ON outside');
        $this->addSql('DROP INDEX IDX_B5EAFDA64B84B276 ON outside');
        $this->addSql('ALTER TABLE outside DROP campus_id, DROP statut_id, DROP place_id, DROP promoter_id');
    }
}
