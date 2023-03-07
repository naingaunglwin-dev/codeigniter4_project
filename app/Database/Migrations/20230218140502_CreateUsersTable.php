<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class CreateUsersTable extends Migration {

        public function up() {

            $this->forge->addField([
                'id'    =>  [
                    'type'              =>  'INT',
                    'constraint'        =>  10,
                    'auto_increment'    =>  true
                ],

                'first_name'  =>    [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  40,
                    'null'          => false
                ],

                'last_name'  =>    [
                    'type'  =>  'VARCHAR',
                    'constraint'    =>  40,
                    'null'  => false
                ],

                'email'  =>    [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  40,
                    'null'          => false
                ],

                'password'  =>    [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  20,
                    'null'          => false
                ],

                'description'   =>  [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  1000,
                    'null'          => true
                ],

                'Type'  =>    [
                    'type'          =>  'INT',
                    'constraint'    =>  10,
                    'null'          => false
                ],
            ]);

            $this->forge->addKey('id', true);

            $this->forge->createTable(MyTable::User);

        }

        public function down() {

            $this->forge->dropTable(MyTable::User);

        }

    }
