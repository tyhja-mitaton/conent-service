<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album}}`.
 */
class m231026_084351_create_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'showcase_id' => $this->string()->notNull(),
            'description' => $this->string(),
            'duration' => $this->integer(),
            'author_name' => $this->string(),
            'author_url' => $this->string(),
            'cover_link' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%album}}');
    }
}
