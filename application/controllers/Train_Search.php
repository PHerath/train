<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train_Search extends CI_Controller {

	public function index()
	{
                $this->load->view('Get_Info');
	}
        
        public function test(){
            
            $data = array ("start" => $_POST['start'],
            "end"=> $_POST['end']);
            $this->load->database(); 
            $this->load->model('basic_search');
            $Sdata=$this->basic_search->get_Staion_info($data);
            
            //check the return value
            if($Sdata!= null){
                //check the date
                //satpos function for get the index of , and substr for get the date name
                $date=$_POST['datepicker'];
                $date=substr($date, 0, strpos($date,','));
                $weekdays=array('Monday','Tuesday','Wendsday','Thursday','Friday');
                //create a copy of $date array
                $Cdata=$data;
                if(in_array($date, $weekdays)){
                    $date=array('MONDAY TO FRIDAY','DAILY','MONDAY TO FRIDAY & SUNDAY');
                    $Cdata['date']=$date;
                }
                elseif($date=='Saturday'){
                    $date=array('DAILY');
                    $Cdata['date']=$date;
                }
                else{
                    $date=array('DAILY','MONDAY TO FRIDAY & SUNDAY');
                    $Cdata['date']=$date;
                }
                //d
                //set the Time
                $time=$_POST['time'];
                //
                $Cdata['time']=$time;
                //
                //echo strpos($date,'y');
                //check wether both inputs are in the same Line
                if ($Sdata[$data['start']]['Line']==$Sdata[$data['end']]['Line']){
                    //Check wether student want to go forward from colombo fort or backword
                    if($Sdata[$data['start']]['ID'] < $Sdata[$data['end']]['ID']){
                        //create array with start,end and line to select correct table from database
                        $data['Line']=$Sdata[$data['start']]['Line'];
                        $Cdata['Line']=$Sdata[$data['start']]['Line'];
                        //calling to model to get train details
                        //print_r($data);
                        $Tdata=$this->basic_search->Get_Train_Infof($Cdata);
                        if($Tdata!=null){
                        //echo $Tdata['1']['Name'];
                        $Farray= array_merge($data,$Tdata);
                        //print_r($Farray);
                        $this->load->view('show_data',array('new'=>$Farray));
                        //$this->load->view('Other.html',array('new'=>$Farray));
                        }
                        
                        //if no derect trains available
                        else{
                            //echo '123';
                            //$Sarry holding the user input staton data
                            $data['Line']=$Sdata[$data['start']]['Line'];
                            $Cdata['Line']=$Sdata[$data['start']]['Line'];
                            $this->load->model('Same_No');
                            //calling the model to get additional train details and saved them to Sarray1 array
                            $Sdata1=$this->Same_No->get_info($Cdata);
                            //taking the express part separately
                            $Earray=$Sdata1['Express'];
                            //Inset Line details to the array
                            $Earray['Line']=$Sdata[$data['start']]['Line'];
                            //create a copy of array
                            $CEarray=$Earray;
                            $CEarray['date']=$date;
                            $CEarray['time']=$time;
                            //taking the normal part separately
                            $Narray=$Sdata1['Normal'];
                            //Inset Line details to the array
                            $Narray['Line']=$Sdata[$data['start']]['Line'];
                            $CNarray=$Narray;
                            $CNarray['date']=$date;
                            $CNarray['time']=$time;
                            //calling the model and get new details
                            $array1=$this->basic_search->Get_Train_Infof($CEarray);
                            //merge two arrays with inserting  new start station end station
                            $Earray= array_merge($Earray,$array1);
                            //print_r($CNarray);
                            $array2=$this->basic_search->Get_Train_Infof($CNarray);
                            //check wether if one of arrays are  empty,,if it is true their are no trains
                            if($array1 !=null && $array2 !=null){
                            $Narray= array_merge($Narray,$array2);
                            $Farray=array($Earray,$Narray);
                            //print_r($Farray);
                            $this->load->view('Other',array('new'=>$Farray));
                            
                            }
                            else{
                                echo 'No tarins are available';
                            }
                        }
                        
                    }
                    else{
                        //create array with start,end and line to select correct table from database    
                        $data['Line']=$Sdata[$data['start']]['Line'];
                        $Cdata['Line']=$Sdata[$data['start']]['Line'];
                        //calling to model to get train details
                        $Tdata=$this->basic_search->Get_Train_Infor($Cdata);
                        if($Tdata!=null){
                        $Farray= array_merge($data,$Tdata);
                        //print_r($Farray[0]);
                        $this->load->view('show_data',array('new'=>$Farray));}
                        
                        //if no derect trains available
                        else{
                            $data['Line']=$Sdata[$data['start']]['Line'];
                            $this->load->model('Same_No');
                            $Sdata=$this->Same_No->get_info($data);
                            print_r($Sdata);
                        }
                    }
                }
                else{
                    //what do if they are not in same line
                }
            }
            else{
                echo "Invalied input";
            }
            
            
        }
}
