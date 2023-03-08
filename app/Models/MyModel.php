<?php

    namespace App\Models;

    class MyModel {

        protected $db;

        public function __construct() {

            $this->db = \Config\Database::connect();

        }


        public function insert_data($table, $data) {

            $insert = $this->db->table($table);
            $insert->insert($data);

            return true;

        }

        public function select_data_array($table, $where) {

            $select = $this->db->table($table);
            $select->select('*')
                   ->where($where);

            return $select->get()->getResultArray();

        }

        public function select_all($table) {

            $select = $this->db->table($table);
            $select->select('*');
            
            foreach ($select->get()->getResult() as $row) {
                $result[$row->id]   =   $row->name;
            }

            return $result;

        }

        public function select_data_object($table, $where) {

            $select = $this->db->table($table);
            $select->select('*')
                   ->where($where);

            return $select->get()->getRow();

        }

        public function count($table, $where) {

            $select = $this->db->table($table);
            return $select->select('*')
                   ->where($where)
                   ->countAllResults();

        }

        public function update_data($table, $data, $id) {

            $update = $this->db->table($table);
            $update->set($data)
                   ->where('id ',$id)
                   ->update();

            return true;

        }

        public function save($id, $table, $data) {

            if ($id) {
                $this->update_data($table, $data, $id);
            } else {
                $this->insert_data($table, $data);                
            }

        }

        public function delete_data($table, $id) {

            $delete = $this->db->table($table);
            $delete->where('id', $id)
                   ->delete();

            return true;

        }

        public function search($table, $data) {

            $search = $this->db->table($table);
            $search->select('*')
                   ->like($data);

            return $search->get()->getResultArray();

        }

    }
