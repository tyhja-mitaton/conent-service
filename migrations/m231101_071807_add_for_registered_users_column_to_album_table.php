<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album}}`.
 */
class m231101_071807_add_for_registered_users_column_to_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album}}', 'for_registered_users', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album}}', 'for_registered_users');
    }
}
