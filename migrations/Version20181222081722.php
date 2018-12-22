<?php declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181222081722 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("SET CHARSET utf8mb4");
        # 书籍增加收藏量
        $user_table = $schema->getTable('users');
        $user_table->addColumn('avatar' , 'string')->setDefault('')->setNotnull(true)->setComment('头像');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
