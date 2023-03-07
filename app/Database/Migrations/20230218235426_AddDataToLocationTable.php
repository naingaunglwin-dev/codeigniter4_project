<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    use App\Models\MyTable;

    class AddDataToLocationTable extends Migration {

        public function up() {

            $location_data  =   [
                ['Yangon'],
                ['Mandalay'],
                ['Nay Pyi Taw'],
                ['Bago'],
                ['Ayeyawaddy']
            ];

            foreach($location_data as $value) {

                $data   =   [
                    'name'  =>  $value
                ];

                $this->db->table(MyTable::Location)->insert($data);

            }

        }

        public function down() {

            $table = $this->db->table(MyTable::Location);
            $table->truncate();

        }

    }
