<?php declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217064144 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql("SET CHARSET utf8mb4");
        # 把likes改成behaviors，增加收藏功能
        $schema->renameTable('likes', 'behaviors');

        # 书籍增加总字数功能
        $book_table = $schema->getTable('books');
        $book_table->addColumn('words' , 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('书籍总字数');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
