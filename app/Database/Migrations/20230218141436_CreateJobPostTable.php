<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class CreateJobPostTable extends Migration {

        public function up() {

            $this->forge->addField([
                'id'    =>  [
                    'type'              => 'INT',
                    'constraint'        => 10,
                    'auto_increment'    =>  true
                ],

                'title'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 40,
                    'null'    =>  false
                ],

                'location'    =>  [
                    'type'              => 'INT',
                    'constraint'        => 5,
                    'null'    =>  false
                ],

                'industry'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 5,
                    'null'    =>  false
                ],

                'responsibilities'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 1000,
                    'null'    =>  false
                ],

                'requirement'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 1000,
                    'null'    =>  false
                ],

                'other_information'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 1000,
                    'null'    =>  false
                ],

                'user_id'    =>  [
                    'type'              => 'INT',
                    'constraint'        => 5,
                    'null'    =>  false
                ],

                'update_date'    =>  [
                    'type'              => 'DATE',
                    'null'    =>  false
                ],

                'apply_method'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 400,
                    'null'    =>  false
                ],

                'img_loc'    =>  [
                    'type'              => 'VARCHAR',
                    'constraint'        => 1000,
                    'null'    =>  false
                ],

                'job_function'    =>  [
                    'type'              => 'INT',
                    'constraint'        => 10,
                    'null'    =>  false
                ]
            ]);

            $this->forge->addKey('id', true);

            $this->forge->createTable(MyTable::Job_Post);

        }

        public function down() {

            $this->forge->dropTable(MyTable::Job_Post);

        }

    }
