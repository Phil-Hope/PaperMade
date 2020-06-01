<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601091338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books DROP FOREIGN KEY books_author_id_fk');
        $this->addSql('DROP INDEX books_author_id_fk ON books');
        $this->addSql('ALTER TABLE change_log DROP FOREIGN KEY change_log_books_id_fk');
        $this->addSql('ALTER TABLE change_log DROP FOREIGN KEY change_log_users_id_fk');
        $this->addSql('DROP INDEX change_log_books_id_fk ON change_log');
        $this->addSql('DROP INDEX change_log_users_id_fk ON change_log');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books ADD CONSTRAINT books_author_id_fk FOREIGN KEY (author_id) REFERENCES author (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX books_author_id_fk ON books (author_id)');
        $this->addSql('ALTER TABLE change_log ADD CONSTRAINT change_log_books_id_fk FOREIGN KEY (book_changed_id) REFERENCES books (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE change_log ADD CONSTRAINT change_log_users_id_fk FOREIGN KEY (changed_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX change_log_books_id_fk ON change_log (book_changed_id)');
        $this->addSql('CREATE INDEX change_log_users_id_fk ON change_log (changed_by_id)');
    }
}
