<?php

use yii\db\Migration;

/**
 * Class m210428_215318_tabla_productos
 */
class m210428_215318_tabla_productos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('productos', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'descripcion' => $this->string(),
            'precio' => $this->decimal(10,2)->notNull(),
            'id_usuario' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey(
            'fk-productos-id_usuario',
            'productos',
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
            'fk-productos-id_usuario',
            'productos'
        );
        $this->dropTable('productos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210428_215318_tabla_productos cannot be reverted.\n";

        return false;
    }
    */
}
