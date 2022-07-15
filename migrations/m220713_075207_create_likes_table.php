<?php


use yii\db\Migration;

/**
 * Handles the creation of table `{{%likes}}`.
 */
class m220713_075207_create_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ermakk_likes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'row_id' => $this->integer()->notNull(),
            'model' => $this->string()->notNull(),
            'created_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'FK_user_to_likes',
            '{{%ermakk_likes}}',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_user_to_likes', '{{%ermakk_likes}}');
        $this->dropTable('{{%ermakk_likes}}');
    }
}
