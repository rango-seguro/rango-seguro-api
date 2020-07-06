<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705171436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, zip_code VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, neighborhood VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, building_number VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, question VARCHAR(255) NOT NULL, score INT NOT NULL, icon VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_FEF0481D989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), INDEX IDX_64C19C13DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, text VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, address_id INT NOT NULL, identification_number VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT \'0\' NOT NULL, score INT DEFAULT 0 NOT NULL, status VARCHAR(255) NOT NULL, capacity INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, trading_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4FBF094F989D9B62 (slug), INDEX IDX_4FBF094F7E3C61F9 (owner_id), INDEX IDX_4FBF094FF98F144A (logo_id), UNIQUE INDEX UNIQ_4FBF094FF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_category (company_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_1EDB0CAC979B1AD6 (company_id), INDEX IDX_1EDB0CAC12469DE2 (category_id), PRIMARY KEY(company_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_image (company_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_82CCA63A979B1AD6 (company_id), INDEX IDX_82CCA63A3DA5256D (image_id), PRIMARY KEY(company_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_badge (id INT AUTO_INCREMENT NOT NULL, badge_id INT NOT NULL, level_id INT NOT NULL, company_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B901EA78F7A2C2FC (badge_id), INDEX IDX_B901EA785FB14BA7 (level_id), INDEX IDX_B901EA78979B1AD6 (company_id), UNIQUE INDEX uniq_company_id_badge_id (company_id, badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_level_report (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, agreed TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4354DCEB5FB14BA7 (level_id), INDEX IDX_4354DCEBA76ED395 (user_id), INDEX IDX_4354DCEB979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, badge_id INT NOT NULL, color VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, score INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9AEACC13F7A2C2FC (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, platform_id INT NOT NULL, company_id INT NOT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_36AC99F1FFE6496F (platform_id), INDEX IDX_36AC99F1979B1AD6 (company_id), UNIQUE INDEX uniq_company_id_platform_id (company_id, platform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ownership_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6DE3D28AA76ED395 (user_id), INDEX IDX_6DE3D28A979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, phone_type VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, extension VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_444F97DD979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, name VARCHAR(255) NOT NULL, price_in_cents INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D34A04AD979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, value INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D8892622A76ED395 (user_id), INDEX IDX_D8892622979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, company_id INT NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C84955979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_category ADD CONSTRAINT FK_1EDB0CAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_image ADD CONSTRAINT FK_82CCA63A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_image ADD CONSTRAINT FK_82CCA63A3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_badge ADD CONSTRAINT FK_B901EA78F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id)');
        $this->addSql('ALTER TABLE company_badge ADD CONSTRAINT FK_B901EA785FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE company_badge ADD CONSTRAINT FK_B901EA78979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company_level_report ADD CONSTRAINT FK_4354DCEB5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE company_level_report ADD CONSTRAINT FK_4354DCEBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company_level_report ADD CONSTRAINT FK_4354DCEB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE level ADD CONSTRAINT FK_9AEACC13F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE ownership_request ADD CONSTRAINT FK_6DE3D28AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ownership_request ADD CONSTRAINT FK_6DE3D28A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF5B7AF75');
        $this->addSql('ALTER TABLE company_badge DROP FOREIGN KEY FK_B901EA78F7A2C2FC');
        $this->addSql('ALTER TABLE level DROP FOREIGN KEY FK_9AEACC13F7A2C2FC');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC12469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C979B1AD6');
        $this->addSql('ALTER TABLE company_category DROP FOREIGN KEY FK_1EDB0CAC979B1AD6');
        $this->addSql('ALTER TABLE company_image DROP FOREIGN KEY FK_82CCA63A979B1AD6');
        $this->addSql('ALTER TABLE company_badge DROP FOREIGN KEY FK_B901EA78979B1AD6');
        $this->addSql('ALTER TABLE company_level_report DROP FOREIGN KEY FK_4354DCEB979B1AD6');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F1979B1AD6');
        $this->addSql('ALTER TABLE ownership_request DROP FOREIGN KEY FK_6DE3D28A979B1AD6');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD979B1AD6');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD979B1AD6');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622979B1AD6');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955979B1AD6');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C13DA5256D');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF98F144A');
        $this->addSql('ALTER TABLE company_image DROP FOREIGN KEY FK_82CCA63A3DA5256D');
        $this->addSql('ALTER TABLE company_badge DROP FOREIGN KEY FK_B901EA785FB14BA7');
        $this->addSql('ALTER TABLE company_level_report DROP FOREIGN KEY FK_4354DCEB5FB14BA7');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F1FFE6496F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F7E3C61F9');
        $this->addSql('ALTER TABLE company_level_report DROP FOREIGN KEY FK_4354DCEBA76ED395');
        $this->addSql('ALTER TABLE ownership_request DROP FOREIGN KEY FK_6DE3D28AA76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_category');
        $this->addSql('DROP TABLE company_image');
        $this->addSql('DROP TABLE company_badge');
        $this->addSql('DROP TABLE company_level_report');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE ownership_request');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE user');
    }
}
