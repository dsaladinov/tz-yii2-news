<?php
use yii\db\Schema;
use yii\db\Migration;

class m161226_155358_create_table_comment extends Migration
{
     public function safeUp()
           {
               $this->execute("
                   CREATE TABLE IF NOT EXISTS `nws_comment` (
                     `id` INT NOT NULL AUTO_INCREMENT,
                     `user_id` INT NOT NULL,
                     `news_id` INT NOT NULL,
                     `comment` VARCHAR(255) NOT NULL,
                     `create_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                     PRIMARY KEY (`id`),
                     INDEX `fk_nws_comment_1_idx` (`user_id` ASC),
                     INDEX `fk_nws_comment_2_idx` (`news_id` ASC),
                     CONSTRAINT `fk_nws_comment_1`
                       FOREIGN KEY (`user_id`)
                       REFERENCES `nws_user` (`id`)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION,
                     CONSTRAINT `fk_nws_comment_2`
                       FOREIGN KEY (`news_id`)
                       REFERENCES `nws_news` (`id`)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION)
                   ENGINE = InnoDB DEFAULT CHARSET UTF8;
               ");
           }
           public function safeDown()
                {
                    $this->execute("
                                DROP TABLE IF EXISTS `nws_comment` ;
                            ");
                }
}
