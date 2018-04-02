<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180324164338 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aluno (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, matricula INT NOT NULL, semestre VARCHAR(255) NOT NULL, INDEX IDX_67C97100E192711F (id_facul), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE av_aluno (id INT AUTO_INCREMENT NOT NULL, id_avbase INT DEFAULT NULL, id_aluno INT DEFAULT NULL, nota DOUBLE PRECISION NOT NULL, INDEX IDX_AAE8A662C33FFCA3 (id_avbase), INDEX IDX_AAE8A662894C3030 (id_aluno), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE av_base (id INT AUTO_INCREMENT NOT NULL, id_tipo INT DEFAULT NULL, id_turma INT DEFAULT NULL, nota_max DOUBLE PRECISION NOT NULL, descricao VARCHAR(255) NOT NULL, INDEX IDX_36650F94FB0D0145 (id_tipo), INDEX IDX_36650F94C5875896 (id_turma), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE av_tipo (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, tipo VARCHAR(255) NOT NULL, INDEX IDX_86FCECB2E192711F (id_facul), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disciplina (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_72D32A26E192711F (id_facul), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faculdade (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professor (id INT AUTO_INCREMENT NOT NULL, id_facul INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_790DD7E3E7927C74 (email), INDEX IDX_790DD7E3E192711F (id_facul), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turma (id INT AUTO_INCREMENT NOT NULL, id_disc INT DEFAULT NULL, id_prof INT DEFAULT NULL, id_facul INT DEFAULT NULL, semestre_turma VARCHAR(255) NOT NULL, INDEX IDX_2B0219A6898F4932 (id_disc), INDEX IDX_2B0219A6D09A6CB9 (id_prof), INDEX IDX_2B0219A6E192711F (id_facul), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turm_aluno (id INT AUTO_INCREMENT NOT NULL, id_turma INT DEFAULT NULL, id_aluno INT DEFAULT NULL, INDEX IDX_FE3B4CF9C5875896 (id_turma), INDEX IDX_FE3B4CF9894C3030 (id_aluno), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aluno ADD CONSTRAINT FK_67C97100E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE av_aluno ADD CONSTRAINT FK_AAE8A662C33FFCA3 FOREIGN KEY (id_avbase) REFERENCES av_base (id)');
        $this->addSql('ALTER TABLE av_aluno ADD CONSTRAINT FK_AAE8A662894C3030 FOREIGN KEY (id_aluno) REFERENCES turm_aluno (id)');
        $this->addSql('ALTER TABLE av_base ADD CONSTRAINT FK_36650F94FB0D0145 FOREIGN KEY (id_tipo) REFERENCES av_tipo (id)');
        $this->addSql('ALTER TABLE av_base ADD CONSTRAINT FK_36650F94C5875896 FOREIGN KEY (id_turma) REFERENCES turma (id)');
        $this->addSql('ALTER TABLE av_tipo ADD CONSTRAINT FK_86FCECB2E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE disciplina ADD CONSTRAINT FK_72D32A26E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE professor ADD CONSTRAINT FK_790DD7E3E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A6898F4932 FOREIGN KEY (id_disc) REFERENCES disciplina (id)');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A6D09A6CB9 FOREIGN KEY (id_prof) REFERENCES professor (id)');
        $this->addSql('ALTER TABLE turma ADD CONSTRAINT FK_2B0219A6E192711F FOREIGN KEY (id_facul) REFERENCES faculdade (id)');
        $this->addSql('ALTER TABLE turm_aluno ADD CONSTRAINT FK_FE3B4CF9C5875896 FOREIGN KEY (id_turma) REFERENCES turma (id)');
        $this->addSql('ALTER TABLE turm_aluno ADD CONSTRAINT FK_FE3B4CF9894C3030 FOREIGN KEY (id_aluno) REFERENCES aluno (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE turm_aluno DROP FOREIGN KEY FK_FE3B4CF9894C3030');
        $this->addSql('ALTER TABLE av_aluno DROP FOREIGN KEY FK_AAE8A662C33FFCA3');
        $this->addSql('ALTER TABLE av_base DROP FOREIGN KEY FK_36650F94FB0D0145');
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A6898F4932');
        $this->addSql('ALTER TABLE aluno DROP FOREIGN KEY FK_67C97100E192711F');
        $this->addSql('ALTER TABLE av_tipo DROP FOREIGN KEY FK_86FCECB2E192711F');
        $this->addSql('ALTER TABLE disciplina DROP FOREIGN KEY FK_72D32A26E192711F');
        $this->addSql('ALTER TABLE professor DROP FOREIGN KEY FK_790DD7E3E192711F');
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A6E192711F');
        $this->addSql('ALTER TABLE turma DROP FOREIGN KEY FK_2B0219A6D09A6CB9');
        $this->addSql('ALTER TABLE av_base DROP FOREIGN KEY FK_36650F94C5875896');
        $this->addSql('ALTER TABLE turm_aluno DROP FOREIGN KEY FK_FE3B4CF9C5875896');
        $this->addSql('ALTER TABLE av_aluno DROP FOREIGN KEY FK_AAE8A662894C3030');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('DROP TABLE av_aluno');
        $this->addSql('DROP TABLE av_base');
        $this->addSql('DROP TABLE av_tipo');
        $this->addSql('DROP TABLE disciplina');
        $this->addSql('DROP TABLE faculdade');
        $this->addSql('DROP TABLE professor');
        $this->addSql('DROP TABLE turma');
        $this->addSql('DROP TABLE turm_aluno');
    }
}
