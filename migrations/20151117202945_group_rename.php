<?php

use Phinx\Migration\AbstractMigration;

class GroupRename extends AbstractMigration
{
    public function change()
    {
        
//        var_dump($this->fetchAll('SHOW CREATE TABLE `messages`;'));
        //var_dump($this->fetchAll('SHOW CREATE TABLE `team_groups`;'));
        
       var_dump($this->fetchAll("
     //   select
 // TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
//from INFORMATION_SCHEMA.KEY_COLUMN_USAGE
//where
  REFERENCED_TABLE_NAME = 'messages';
        "));
        
        $this->execute("alter table player_groups drop foreign key player_groups_ibfk_1");
        $this->execute("alter table player_groups drop foreign key player_groups_ibfk_2");
        $this->execute("alter table team_groups drop foreign key team_groups_ibfk_1");
        $this->execute("alter table team_groups drop foreign key team_groups_ibfk_2");
        
     //   $this->table('groups')->rename('conversations');
        
        var_dump("hi");

        $table = $this->dropForeignKeys($this->table('player_groups'))
            ->rename('player_conversations')
            ->renameColumn('group', 'conversation');

        $this->dropForeignKeys($this->table('team_groups'))
            ->rename('team_conversations')
            ->renameColumn('group', 'conversation');

        $messages = $this->table('messages');
        $this->dropForeignKeys($messages);
        $messages->renameColumn('group_to', 'conversation_to');
        
        die();
    }
    
    private function dropForeignKeys($table) {
        $keys = $table->getForeignKeys();
	var_dump($keys);
        foreach ($keys as $key) {
            $table->dropForeignKey($key->getColumns(), $key->getConstraint());
        }
        
        $table->update();
        
        return $table;
    }
}
