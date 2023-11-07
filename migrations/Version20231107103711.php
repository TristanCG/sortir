<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107103711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_outside (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_outside_users (users_outside_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_92E8BAC08D12DF55 (users_outside_id), INDEX IDX_92E8BAC067B3B43D (users_id), PRIMARY KEY(users_outside_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_outside_outside (users_outside_id INT NOT NULL, outside_id INT NOT NULL, INDEX IDX_7CA4E9D38D12DF55 (users_outside_id), INDEX IDX_7CA4E9D35A7970C1 (outside_id), PRIMARY KEY(users_outside_id, outside_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_outside_users ADD CONSTRAINT FK_92E8BAC08D12DF55 FOREIGN KEY (users_outside_id) REFERENCES users_outside (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_outside_users ADD CONSTRAINT FK_92E8BAC067B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_outside_outside ADD CONSTRAINT FK_7CA4E9D38D12DF55 FOREIGN KEY (users_outside_id) REFERENCES users_outside (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_outside_outside ADD CONSTRAINT FK_7CA4E9D35A7970C1 FOREIGN KEY (outside_id) REFERENCES outside (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_outside_users DROP FOREIGN KEY FK_92E8BAC08D12DF55');
        $this->addSql('ALTER TABLE users_outside_users DROP FOREIGN KEY FK_92E8BAC067B3B43D');
        $this->addSql('ALTER TABLE users_outside_outside DROP FOREIGN KEY FK_7CA4E9D38D12DF55');
        $this->addSql('ALTER TABLE users_outside_outside DROP FOREIGN KEY FK_7CA4E9D35A7970C1');
        $this->addSql('DROP TABLE users_outside');
        $this->addSql('DROP TABLE users_outside_users');
        $this->addSql('DROP TABLE users_outside_outside');
    }
}
