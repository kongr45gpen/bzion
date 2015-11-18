<?php

use Phinx\Migration\AbstractMigration;

class GroupRename extends AbstractMigration
{
    public function change()
    {
        
        var_dump($this->fetchAll('SHOW CREATE TABLE `player_groups`;'));
        var_dump($this->fetchAll('SHOW CREATE TABLE `team_groups`;'));
        
        var_dump($this->fetchAll("
        select
  TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
from INFORMATION_SCHEMA.KEY_COLUMN_USAGE
where
  REFERENCED_TABLE_NAME = 'player_groups' OR REFERENCED_TABLE_NAME='team_groups';
        "))
        
        $this->table('groups')->rename('conversations');
        
        var_dump("hi");

        $this->table('player_groups')
            ->rename('player_conversations')
            ->renameColumn('group', 'conversation');

        $this->table('team_groups')
            ->rename('team_conversations')
            ->renameColumn('group', 'conversation');

        $messages = $this->table('messages');
        $messages->renameColumn('group_to', 'conversation_to');
        

    }
}
