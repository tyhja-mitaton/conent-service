<?php

use yii\db\Migration;

/**
 * Class m231103_124707_drop_redundant_columns
 */
class m231103_124707_drop_redundant_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'email');
        $this->dropColumn('{{%user}}', 'registration_type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%user}}', 'email', $this->string()->notNull());
        $this->addColumn('{{%user}}', 'registration_type', $this->integer()->defaultValue(0));
    }
}
