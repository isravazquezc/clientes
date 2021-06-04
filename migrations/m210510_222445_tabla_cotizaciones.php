<?php

use yii\db\Migration;

/**
 * Class m210510_222445_tabla_cotizaciones
 */
class m210510_222445_tabla_cotizaciones extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cotizaciones',
     [
            'id' => $this->primaryKey(),
            'fecha' => $this->date()->notNull(),
            'id_cliente' => $this->integer()->notNull(),
            'id_usuario' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk-cotizaciones-id_usuario',
            'cotizaciones',
            'id_usuario',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cotizaciones-id_cliente',
            'cotizaciones',
            'id_cliente',
            'clientes',
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
            'fk-cotizaciones-id_usuario',
            'cotizaciones'
        );
        $this->dropForeignKey(
            'fk-cotizaciones-id_cliente',
            'cotizaciones'
        );
        $this->dropTable('cotizaciones');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210510_222445_tabla_cotizaciones cannot be reverted.\n";

        return false;
    }
    */
}
