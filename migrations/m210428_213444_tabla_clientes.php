<?php

use yii\db\Migration;

/**
 * Class m210428_213444_tabla_clientes
 */
class m210428_213444_tabla_clientes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clientes', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'rfc' => $this->string(),
            'calle' => $this->string(),
            'numero' => $this->string(),
            'cp' => $this->string(),
            'ciudad' => $this->string(),
            'pais' => $this->string(),
            'id_usuario' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk-clientes-id_usuario',
            'clientes',
            'id_usuario',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-clientes-id_usuario',
            'clientes'
        );
        $this->dropTable('clientes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210428_213444_tabla_clientes cannot be reverted.\n";

        return false;
    }
    */
}
