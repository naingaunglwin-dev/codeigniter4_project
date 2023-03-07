<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class CreateJobFunctionTable extends Migration {

        public function up() {

            $this->forge->addField([
                'id'    =>  [
                    'type'              =>  'INT',
                    'constraint'        =>  5,
                    'auto_increment'    => true
                ],

                'name'    =>  [
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  20,
                    'null'          => false
                ],
            ]);

            $this->forge->addKey('id', true);

            $this->forge->createTable(MyTable::Job_Function);

        }

        public function down() {

            $this->forge->dropTable(MyTable::Job_Function);

        }
    }
