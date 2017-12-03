<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class basic_search extends CI_Model{
    
    function index(){
        $query = $this->db->get_where('Train_Details', array('ID' => '2'));
        foreach($query->result() as $row)
            {
                print $row->ID;
                print $row->Name;
                print "<br>";
            }
        
    }
    
    
    
    //function for get station line details and no
    function get_Staion_info($data){
        
        $this->db->from('Get_Station_Details');
        $this->db->where('Name', $data['start']);
        $this->db->or_where('Name', $data['end']);
        $query = $this->db->get();
        
        //check user input correct start and end 
        if($query->num_rows()<2){
            //if invalied return null
            return null;
        }
        else{
            //If correct get tge values form table
        $Sdata = array();
        foreach($query->result() as $row)
            {
            $Sdata[$row->Name]=array("ID"=>$row->ID , "Line" => $row->Line);
            }
            
            //return result array back to the controller
            return $Sdata;
        }
    }
    
    //funtion for get train details from database
    function Get_Train_Infof($data){
        $Tdata=array();
        //create an array with train details
        $TTdata = array();
        $Eline=$data['Line']."_E_Train";
        $Nline=$data['Line']."_N_Train";
        $start=$data['start'];
        $end=$data['end'];
        $time=$data['time'];
        //query for search Express train
        $Equery = $this->db->query("SELECT ID,$start,$end FROM $Eline where $start IS NOT NULL AND $end IS NOT NULL AND $start >= $time ORDER BY $start");
        //if both two coloums are exist check if not error
        if($Equery){
            //get the result
               
                foreach($Equery->result() as $row)
                    {
                    //getting the trains comparing the times
                    if($row->$start < $row->$end){
                        $Tdata[$row->ID]=array($start=>$row->$start,$end=>$row->$end);
                        }
                    }
                //getting the train IDS to get train details    
                $keys=array_keys($Tdata);
                //if no data resieved skip..if it,s not $keys[0] makes error,if fristly did,t fill the array named $Tdata
                if(count($keys)!=0){
                //select the train details table
                $this->db->from('Train_Details');
                //get the frist train details
                $this->db->where('ID', $keys[0]);
                //if more trains available get them details
                if($Equery->num_rows()>1){
                    $total = count($keys);
                    //until keys ends
                    for($i=1;$i<$total;$i++){
                        //use or_where to get them
                        $this->db->or_where('ID', $keys[$i]);
                    }}
                //get the results
                $query1 = $this->db->get();

                foreach($query1->result() as $row)
                    {
                    if(in_array($row->Availability, $data['date']))
                    {
                    $TTdata[$row->ID]=array("Name"=>$row->Name , "Type" => $row->Type,"Availability"=> $row->Availability);
                    }
                }}
                    //echo $TTdata[2]['Name'];
        }
            
            
           
        $Squery = $this->db->query("SELECT ID,$start,$end FROM $Nline where $start IS NOT NULL AND $end IS NOT NULL AND $start >= $time ORDER BY $start");
        //if both two coloums are exist check if not error
        if($Squery){
            //get the result   
                foreach($Squery->result() as $row)
                    {
                    //getting the trains comparing the times
                    if($row->$start < $row->$end){
                        $Tdata[$row->ID]=array($start=>$row->$start,$end=>$row->$end);
                        }
                    }
                //getting the train IDS to get train details    
                $keys=array_keys($Tdata);
                //if no data resieved skip..if it,s not $keys[0] makes error,if fristly did,t fill the array named $Tdata
                if(count($keys)!=0){
                //select the train details table
                $this->db->from('Train_Details');
                //get the frist train details
                $this->db->where('ID', $keys[0]);
                //if more trains available get them details
                if($Squery->num_rows()>1){
                    $total = count($keys);
                    //until keys ends
                    for($i=1;$i<$total;$i++){
                        //use or_where to get them
                        $this->db->or_where('ID', $keys[$i]);
                    }}
                //get the results
                $query1 = $this->db->get();

                foreach($query1->result() as $row){
                    if(in_array($row->Availability, $data['date']))
                    {
                    $TTdata[$row->ID]=array("Name"=>$row->Name , "Type" => $row->Type,"Availability"=> $row->Availability);
                    }
                }}
                    //echo $TTdata[2]['Name'];
    }

            //combine two arrays
    $Farray=array();
    //get the keys of frist array
    $keys=array_keys($Tdata);
    //get the keys of second array
    $keyss=array_keys($TTdata);
    //intersection of two arrays to remove extra trains
    $keys= array_intersect($keys, $keyss);
    foreach($keys as $key)
                    {
                    $Farray[$key]=array_merge($Tdata[$key] , $TTdata[$key]);
                    }
                    //print_r($Farray);
    if(count($Farray)!=0){
        return $Farray; 
        }
    else {
        return null;    
        }
    }
    
    
    
    function Get_Train_Infor($data){
        $Tdata=array();
        $Eline=$data['Line']."_E_Train";
        $Nline=$data['Line']."_N_Train";
        $start=$data['start'];
        $end=$data['end'];
        $time=$data['time'];
        $Equery = $this->db->query("SELECT ID,$start,$end FROM $Eline where $start IS NOT NULL AND $end IS NOT NULL AND $start >= $time ORDER BY $start");
        //if both two coloums are exist check if not error
        if($Equery){
            //get the result   
                foreach($Equery->result() as $row)
                    {
                    //getting the trains comparing the times
                    if($row->$start < $row->$end){
                        $Tdata[$row->ID]=array($start=>$row->$start,$end=>$row->$end);
                        }
                    }
                //getting the train IDS to get train details    
                $keys=array_keys($Tdata);
                //if no data resieved skip..if it,s not $keys[0] makes error,if fristly did,t fill the array named $Tdata
                if(count($keys)!=0){
                //select the train details table
                $this->db->from('Train_Details');
                //get the frist train details
                $this->db->where('ID', $keys[0]);
                //if more trains available get them details
                if($Equery->num_rows()>1){
                    $total = count($keys);
                    //until keys ends
                    for($i=1;$i<$total;$i++){
                        //use or_where to get them
                        $this->db->or_where('ID', $keys[$i]);
                    }}
                //get the results
                $query1 = $this->db->get();
                //create an array with train details
                $TTdata = array();
                foreach($query1->result() as $row)
                    {
                    if(in_array($row->Availability, $data['date']))
                    {
                    $TTdata[$row->ID]=array("Name"=>$row->Name , "Type" => $row->Type,"Availability"=> $row->Availability);
                    }
        }}}
                    //echo $TTdata[2]['Name'];
                 
        $Squery = $this->db->query("SELECT ID,$start,$end FROM $Nline where $start IS NOT NULL AND $end IS NOT NULL AND $start >= $time ORDER BY $start");
        //if both two coloums are exist check if not error
        if($Squery){
            //get the result   
                foreach($Squery->result() as $row)
                    {
                    //getting the trains comparing the times
                    if($row->$start < $row->$end){
                        $Tdata[$row->ID]=array($start=>$row->$start,$end=>$row->$end);
                        }
                    }
                //getting the train IDS to get train details    
                $keys=array_keys($Tdata);
                //if no data resieved skip..if it,s not $keys[0] makes error,if fristly did,t fill the array named $Tdata
                if(count($keys)!=0){
                //select the train details table
                $this->db->from('Train_Details');
                //get the frist train details
                $this->db->where('ID', $keys[0]);
                //if more trains available get them details
                if($Squery->num_rows()>1){
                    $total = count($keys);
                    //until keys ends
                    for($i=1;$i<$total;$i++){
                        //use or_where to get them
                        $this->db->or_where('ID', $keys[$i]);
                    }}
                //get the results
                $query1 = $this->db->get();

                foreach($query1->result() as $row)
                    {
                    if(in_array($row->Availability, $data['date']))
                    {
                    $TTdata[$row->ID]=array("Name"=>$row->Name , "Type" => $row->Type,"Availability"=> $row->Availability);
                    }
            }}
                    //echo $TTdata[2]['Name'];
        }
            
            
            //combine two arrays
    $Farray=array();
    //get the keys of frist array
    $keys=array_keys($Tdata);
    //get the keys of second array
    $keyss=array_keys($TTdata);
    //intersection of two arrays to remove extra trains
    $keys= array_intersect($keys, $keyss);
    foreach($keys as $key)
                    {
                    $Farray[$key]=array_merge($Tdata[$key] , $TTdata[$key]);
                    }
                    //print_r($Farray);
    if(count($Farray)!=0){
        return $Farray; 
        }
    else {
        return null;    
        }
        
    }
    
}

