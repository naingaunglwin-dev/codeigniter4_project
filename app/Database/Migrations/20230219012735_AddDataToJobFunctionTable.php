<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class AddDataToJobFunctionTable extends Migration {

        public function up() {

            $location_data  =   [
                ['Web Developer'],
                ['Marketing Manager'],
                ['Human Resources'],
                ['Sale Representative'],
                ['Accountant']
            ];

            foreach($location_data as $value) {

                $data   =   [
                    'name'  =>  $value
                ];

                $this->db->table(MyTable::Job_Function)->insert($data);

            }

        }

        public function down() {

            $table = $this->db->table(MyTable::Job_Function);
            $table->truncate();

        }

    }
