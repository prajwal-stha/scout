<?php
/**
 * Created by PhpStorm.
 * User: nirmal
 * Date: 25/04/2016
 * Time: 15:15
 */

namespace App\Scout\Service;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class CloneTable
{

    protected $form;
    protected $to;
    protected $data;
    protected $overwrite;
    protected $multipleOverwrite;
    protected $errors = array();

    public function __construct(){

    }

    /**
     * @param Model $from : concrete object of what to clone
     * @param Model $to : empty object where we will be populating with data
     * @param $attributes : what attribtes need to be cloned
     */
    public function cloneObject(Model $from, Model $to, $attributes){

        $this->to  = $to;

        foreach ($attributes as $key) {

            $this->data[$key] = $from->$key;

        }

        $this->createModel();

    }

    /**
     * @param array $models
     * @param Model $to
     * @param array $attributes
     * @param array $overwrite
     */
    public function cloneMultipleObjects($models = array(), Model $to, $attributes = array(), $overwrite = array()){

        $this->setMultipleOverwrite($overwrite);

        $count = count($this->multipleOverwrite);

        for($i = 0; $i < $count; $i++){

            $this->overwrite = array();

            $this->overwrite = array(
                'original_id' => $this->multipleOverwrite[$i]
            );

            $this->cloneObject($models[$i], $to, $attributes);

        }

    }

    protected function createModel(){

        // Check if there is any overwrite
        if(count($this->overwrite)){

            $entry_data = $this->tamper_data();

        }else{

            $entry_data = $this->data;
        }



        try{

            $this->to->create($entry_data);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){

                $this->errors[] = 'Duplicate data not allowed';

            }
        }

    }

    protected function tamper_data(){

        return array_merge($this->data, $this->overwrite);

    }


    public function setOverwrite($overwrite = array()){

        $this->overwrite = $overwrite;

    }

    protected function setMultipleOverwrite($overwrites = array()){

        $this->multipleOverwrite = $overwrites;

    }


    public function errors(){

        if(count($this->errors)){
            return $this->errors;
        }

        return false;

    }

}