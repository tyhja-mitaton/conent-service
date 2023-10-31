<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m231030_120332_add_phone_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'phone', $this->bigInteger()->unique());
        $this->addColumn('{{%user}}', 'confirm_code', $this->string(4));
        $this->addColumn('{{%user}}', 'registration_type', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'confirm_code');
        $this->dropColumn('{{%user}}', 'registration_type');
    }
}
