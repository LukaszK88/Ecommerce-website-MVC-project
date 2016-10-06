<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 28/09/2016
 * Time: 12:09
 */
class Build {



/*$build->input(array(
    'type' =>'text',
    'name' =>'name'
));*/


    public function input($specs=[]){
        foreach ($specs as $spec => $value) {
            $input[] = $spec."=".$value;
        }
        $string = implode(' ',$input);
        
        echo "<input ".$string.">";
    }

    public function link($name,$specs=[]){
        foreach ($specs as $spec => $value) {
            $input[] = $spec."=".$value;
        }
        $string = implode(' ',$input);

        echo "<a ".$string.">".$name."</a>";
        unset($this->input);
    }
    
    public function openForm($method = 'post'){
        echo "<form action='' method=$method>";
    }

    public function closeForm(){
        echo "</form>";
    }

   
    public function submit($name){
        echo "<button type='submit'>".$name."</button>";
    }

    public function button($name,$specs=[]){
        foreach ($specs as $spec => $value) {
            $input[] = $spec."=".$value;
        }
        $string = implode(' ',$input);

        echo "<button ".$string.">".$name."</button>";
        unset($this->input);
    }


}