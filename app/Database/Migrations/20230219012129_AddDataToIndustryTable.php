<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class AddDataToIndustryTable extends Migration {

        public function up() {

            $location_data  =   [
                ['Technology'],
                ['Healthcare'],
                ['Manufacturing'],
                ['Finance'],
                ['Education']
            ];

            foreach($location_data as $value) {

                $data   =   [
                    'name'  =>  $value
                ];

                $this->db->table(MyTable::Industry)->insert($data);

            }

        }

        public function down() {

            $table = $this->db->table(MyTable::Industry);
            $table->truncate();

        }

    }
