<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180515181303 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, id_professor INT DEFAULT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(40) NOT NULL, role VARCHAR(50) NOT NULL, password VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), INDEX IDX_2265B05DE192711F (id_facul), INDEX IDX_2265B05DF9386BC4 (id_professor), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DE192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DF9386BC4 FOREIGN KEY (id_professor) REFERENCES professor (id)');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, id_turma INT NOT NULL, UNIQUE INDEX UNIQ_CA3B40ECC5875896 (id_turma), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, id_professor INT DEFAULT NULL, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(40) NOT NULL COLLATE utf8_unicode_ci, role VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, password VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649E192711F (id_facul), INDEX IDX_8D93D649F9386BC4 (id_professor), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F9386BC4 FOREIGN KEY (id_professor) REFERENCES professor (id)');
        $this->addSql('DROP TABLE usuario');
    }
}
