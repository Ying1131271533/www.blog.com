<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateBlogsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('blogs', function (Mapping $mapping, Settings $settings) {
            // $mapping->integer('id'); // 不需要id，只需要被拿来检索的字段
            $mapping->integer('user_id');
            $mapping->integer('category_id');
            $mapping->text('title', ['analyzer' => 'ik_max_word', 'search_analyzer' => 'ik_smart']);
            $mapping->text('content', ['analyzer' => 'ik_max_word', 'search_analyzer' => 'ik_smart']);
            $mapping->integer('status');

            // 修改设置
            $settings->index([
                'number_of_replicas' => 2,
                // 刷新数据，默认为1秒，批量添加数据时可以设为 -1 ，将不会刷新数据，
                'refresh_interval' => -1
            ]);

            // 修改数据类型
            // $settings->analysis([
            //     'analyzer' => [
            //         'title' => [
            //             'type' => 'custom',
            //             'tokenizer' => 'whitespace'
            //         ]
            //     ]
            // ]);
        });

    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('blogs');
    }
}
