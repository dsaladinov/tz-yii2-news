<?php
use yii\db\Schema;
use yii\db\Migration;

class m161226_143939_create_table_news extends Migration
{
    public function safeUp()
       {
           $this->execute("
               CREATE TABLE IF NOT EXISTS `nws_news` (
                 `id` INT NOT NULL AUTO_INCREMENT,
                 `user_id` INT NOT NULL,
                 `description` VARCHAR(255) NOT NULL,
                 `article` TEXT NOT NULL,
                 `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                 PRIMARY KEY (`id`),
                 INDEX `fk_nws_news_1_idx` (`user_id` ASC),
                 CONSTRAINT `fk_nws_news_1`
                   FOREIGN KEY (`user_id`)
                   REFERENCES `nws_user` (`id`)
                   ON DELETE NO ACTION
                   ON UPDATE NO ACTION)
               ENGINE = InnoDB DEFAULT CHARSET UTF8;
           ");
       }
       public function safeDown()
            {
                $this->execute("
                            DROP TABLE IF EXISTS `nws_news` ;
                        ");
            }
}
