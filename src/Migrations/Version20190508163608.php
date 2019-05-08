<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190508163608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_20190508 DROP FOREIGN KEY FK_513512758629F781');
        $this->addSql('DROP INDEX IDX_513512758629F781 ON comment_20190508');
        $this->addSql('ALTER TABLE comment_20190508 ADD article_id INT DEFAULT NULL, DROP article_id_20190508');
        $this->addSql('ALTER TABLE comment_20190508 ADD CONSTRAINT FK_513512757294869C FOREIGN KEY (article_id) REFERENCES article_20190508 (id)');
        $this->addSql('CREATE INDEX IDX_513512757294869C ON comment_20190508 (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_20190508 DROP FOREIGN KEY FK_513512757294869C');
        $this->addSql('DROP INDEX IDX_513512757294869C ON comment_20190508');
        $this->addSql('ALTER TABLE comment_20190508 ADD article_id_20190508 INT NOT NULL, DROP article_id');
        $this->addSql('ALTER TABLE comment_20190508 ADD CONSTRAINT FK_513512758629F781 FOREIGN KEY (article_id_20190508) REFERENCES article_20190508 (id)');
        $this->addSql('CREATE INDEX IDX_513512758629F781 ON comment_20190508 (article_id_20190508)');
    }
}
