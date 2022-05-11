<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_undangan extends CI_Model {

    public function __construct()
    {
    parent::__construct();
    }
    
    //insert update delete ada pada system/core/model
    public function get_data_komen(){
        $sql = "SELECT * FROM komen 
        ORDER BY id DESC
        ";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        $result = $query->result_array();
        $query->free_result();
        return $result;
        }else{
        return array();
        }
    }

    // public function get_pxro_by_na_perk($na_perk){
    //     $sql = "SELECT no_perk FROM pxro 
    //     WHERE na_perk = ?
    //     ";
    //     //execute query
    //     $query = $this->db->query($sql,$na_perk);
    //     if ($query->num_rows() > 0) {
    //     $result = $query->row_array();
    //     $query->free_result();
    //     return $result['no_perk'];
    //     }else{
    //     return array();
    //     }
    // }

}