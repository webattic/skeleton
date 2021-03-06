<?php

class m140710_082653_Users extends CDbMigration
{
	public function safeUp()
	{
        // create table
        $this->createTable('users', array(
            'id'        => 'pk',
            'email'     => 'varchar(50) NOT NULL',
            'password'  => 'varchar(60) NOT NULL',
            'salt'      => 'varchar(15) NOT NULL',
            'name'      => 'varchar(50) NULL',
            'role'      => 'varchar(20) NOT NULL',
            'status'    => "ENUM('active', 'deleted') NOT NULL DEFAULT 'active'",
        ));

        // add default admin user
        $salt = \Model\User::generateSalt(15);
        $passwordHash = \Model\User::getPasswordHash('admin', $salt);

        $this->insert('users', array(
            'email'     => 'admin@matyash.pw',
            'password'  => $passwordHash,
            'salt'      => $salt,
            'name'      => 'SkeletonAdmin',
            'role'      => \Model\User::ROLE_ADMINISTRATOR,
        ));
	}

	public function safeDown()
	{
        $this->dropTable('users');
	}

}