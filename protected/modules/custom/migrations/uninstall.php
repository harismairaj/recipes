<?php
use yii\db\Migration;
class uninstall extends Migration
{
    public function up()
    {
        $this->dropTable('social_network');
    }
}
