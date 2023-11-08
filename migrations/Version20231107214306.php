<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107214306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, zipcode VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE outside (id INT AUTO_INCREMENT NOT NULL, campus_id INT NOT NULL, statut_id INT NOT NULL, place_id INT NOT NULL, promoter_id INT NOT NULL, name VARCHAR(255) NOT NULL, date_time_start DATETIME NOT NULL, duration INT NOT NULL, date_limit_register DATE NOT NULL, register_max INT NOT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_B5EAFDA6AF5D55E1 (campus_id), INDEX IDX_B5EAFDA6F6203804 (statut_id), INDEX IDX_B5EAFDA6DA6A219 (place_id), INDEX IDX_B5EAFDA64B84B276 (promoter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE outside_user (outside_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_661A0D955A7970C1 (outside_id), INDEX IDX_661A0D95A76ED395 (user_id), PRIMARY KEY(outside_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_741D53CD8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, campus_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649AF5D55E1 (campus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA6DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE outside ADD CONSTRAINT FK_B5EAFDA64B84B276 FOREIGN KEY (promoter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE outside_user ADD CONSTRAINT FK_661A0D955A7970C1 FOREIGN KEY (outside_id) REFERENCES outside (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE outside_user ADD CONSTRAINT FK_661A0D95A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6AF5D55E1');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6F6203804');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA6DA6A219');
        $this->addSql('ALTER TABLE outside DROP FOREIGN KEY FK_B5EAFDA64B84B276');
        $this->addSql('ALTER TABLE outside_user DROP FOREIGN KEY FK_661A0D955A7970C1');
        $this->addSql('ALTER TABLE outside_user DROP FOREIGN KEY FK_661A0D95A76ED395');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD8BAC62AF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AF5D55E1');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE outside');
        $this->addSql('DROP TABLE outside_user');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
