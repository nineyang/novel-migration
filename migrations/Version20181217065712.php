<?php declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217065712 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("SET CHARSET utf8mb4");
        # 书籍增加收藏量
        $book_table = $schema->getTable('books');
        $book_table->addColumn('collections' , 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('书籍总收藏量');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
