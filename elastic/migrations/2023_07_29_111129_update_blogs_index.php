<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class UpdateBlogsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        // 更新映射
        Index::putMapping('blogs', function (Mapping $mapping) {
            // $mapping->text('title', ['analyzer' => 'standard']); // 字段类型不能修改
            $mapping->integer('view'); // 加一个字段
        });
        // 更新设置
        Index::putSettings('blogs', function (Settings $settings) {
            $settings->index([
                'number_of_replicas' => 2,
                'refresh_interval' => '1s'
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        //
    }
}
