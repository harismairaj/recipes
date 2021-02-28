<?php
use yii\db\Migration;

class m160309_181254_social_network extends Migration
{
    public function up()
    {
        $this->createTable('social_network', array(
            'id' => 'pk',
            'data' => 'text NOT NULL',
            'network' => 'varchar(255) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL'
        ),'');
    }

}
