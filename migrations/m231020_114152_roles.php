<?php

use yii\db\Migration;

/**
 * Class m231020_114152_roles
 */
class m231020_114152_roles extends Migration
{
    public function up()
    {
        $auth = \Yii::$app->get('authManager');
        $auth->removeAll();

        $general = $auth->createRole('general');
        $auth->add($general);

        $admin = $auth->createRole('administrator');
        $auth->add($admin);
        $auth->addChild($admin, $general);
    }

    public function down()
    {
        $auth = \Yii::$app->get('authManager');
        $auth->remove($auth->getRole('general'));
        $auth->remove($auth->getRole('administrator'));
    }
}
