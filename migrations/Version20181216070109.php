<?php declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216070109 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql("SET CHARSET utf8mb4");
        # users
        $user_table = $schema->createTable('users')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $user_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $user_table->addColumn('name', 'string')->setLength(32)->setDefault('')->setNotnull(true);
        $user_table->addColumn('open_id', 'string')->setLength(128)->setDefault('')->setNotnull(true);
        $user_table->addColumn('union_id', 'string')->setLength(128)->setDefault('')->setNotnull(true);
        $user_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $user_table->addColumn('balance', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('余额');
        $user_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $user_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $user_table->setPrimaryKey(['id']);

        # books
        $book_table = $schema->createTable('books')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $book_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $book_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $book_table->addColumn('title', 'string')->setLength(32)->setDefault('')->setNotnull(true);
        $book_table->addColumn('description', 'text');
        $book_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $book_table->addColumn('type', 'smallint')->setNotnull(true)->setComment('小说类型');
        $book_table->addColumn('cover', 'string')->setLength(128)->setDefault('')->setNotnull(true)->setComment('小说封面');
        $book_table->addColumn('views', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('阅读量');
        $book_table->addColumn('likes', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('点赞量');
        $book_table->addColumn('chapter_price', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true)->setComment('每章的价格');
        $book_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $book_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $book_table->setPrimaryKey(['id']);

        # chapters
        $chapter_table = $schema->createTable('chapters')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $chapter_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $chapter_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $chapter_table->addColumn('book_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $chapter_table->addColumn('title', 'string')->setLength(32)->setDefault('')->setNotnull(true);
        $chapter_table->addColumn('context', 'text')->setComment('小说内容');
        $chapter_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $chapter_table->addColumn('serial_number', 'integer')->setDefault(1)->setNotnull(true)->setComment('小说序号，第x章');
        $chapter_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $chapter_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $chapter_table->setPrimaryKey(['id']);

        # comments
        $comment_table = $schema->createTable('comments')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $comment_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $comment_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $comment_table->addColumn('book_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $comment_table->addColumn('context', 'text')->setComment('评价内容');
        $comment_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $comment_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $comment_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $comment_table->setPrimaryKey(['id']);

        # incomes
        $income_table = $schema->createTable('incomes')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $income_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $income_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $income_table->addColumn('object_id', 'bigint')->setDefault(0)->setNotnull(true)->setUnsigned(true)->setComment('收入来源，比如充值的id，签到的id等');
        $income_table->addColumn('type', 'smallint')->setDefault(1)->setNotnull(true)->setComment('收入来源的类型');
        $income_table->addColumn('amount', 'integer')->setDefault(1)->setNotnull(true)->setComment('收入来源的数额');
        $income_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $income_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $income_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $income_table->setPrimaryKey(['id']);

        # payouts
        $payout_table = $schema->createTable('payouts')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $payout_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $payout_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $payout_table->addColumn('object_id', 'bigint')->setDefault(0)->setNotnull(true)->setUnsigned(true)->setComment('支出原因，比如阅读某个章节的id等');
        $payout_table->addColumn('type', 'smallint')->setDefault(1)->setNotnull(true)->setComment('支出原因的类型');
        $payout_table->addColumn('amount', 'integer')->setDefault(1)->setNotnull(true)->setComment('支出原因的数额');
        $payout_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $payout_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $payout_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $payout_table->setPrimaryKey(['id']);

        # likes
        $like_table = $schema->createTable('likes')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $like_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $like_table->addColumn('user_id', 'bigint')->setUnsigned(true)->setDefault(0)->setNotnull(true);
        $like_table->addColumn('object_id', 'bigint')->setDefault(0)->setNotnull(true)->setUnsigned(true)->setComment('书籍or评论点赞');
        $like_table->addColumn('type', 'smallint')->setDefault(1)->setNotnull(true)->setComment('点赞类型');
        $like_table->addColumn('is_canceled', 'smallint')->setDefault(0)->setNotnull(true)->setComment('是否取消');
        $like_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $like_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $like_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $like_table->setPrimaryKey(['id']);

        # recommends
        $recommend_table = $schema->createTable('recommends')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $recommend_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $recommend_table->addColumn('type', 'smallint')->setDefault(1)->setNotnull(true)->setComment('推荐类型');
        $recommend_table->addColumn('book_ids', 'text')->setComment('推荐数据的ids');
        $recommend_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $recommend_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $recommend_table->setPrimaryKey(['id']);

        # book_types
        $book_type_table = $schema->createTable('book_types')->addOption("collate", "utf8mb4_unicode_ci")->addOption("charset", "utf8mb4");
        $book_type_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
        $book_type_table->addColumn('name', 'string')->setLength(16)->setNotnull(true)->setDefault('');
        $book_type_table->addColumn('description', 'text')->setComment('描述');
        $book_type_table->addColumn('sort', 'smallint')->setDefault(1)->setNotnull(true)->setComment('分类排序');
        $book_type_table->addColumn('status', 'smallint')->setDefault(0)->setNotnull(true);
        $book_type_table->addColumn('created_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $book_type_table->addColumn('updated_at', 'bigint')->setDefault(0)->setUnsigned(true)->setNotnull(true);
        $book_type_table->setPrimaryKey(['id']);

        # metas 使用nosql 替代 mysql
//        $meta_table = $schema->createTable('metas');
//        $meta_table->addColumn('id', 'bigint')->setAutoincrement(true)->setUnsigned(true);
//        $meta_table->addColumn('key' , 'string')->setLength(64)->setNotnull(true)->setDefault('');
//        $meta_table->addColumn('value', 'text')->setComment('内容');
//        $meta_table->addColumn('created_at', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true);
//        $meta_table->addColumn('updated_at', 'integer')->setDefault(0)->setUnsigned(true)->setNotnull(true);
//        $meta_table->setPrimaryKey(['id']);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
