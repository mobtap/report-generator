<?php
require_once dirname(__FILE__)."/../autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\Filter;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use \koolreport\processes\Limit;

class Report extends KoolReport
{
    function settings()
    {
        // Configuração do banco
        return array(
            "dataSources"=>array(
                "data_src"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=testes;port=3306",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                ),
            )
        ); 
    }

    protected function setup()
    {
        // Configuração do relatório. Campos: date/mês - horizontal, value - vertical
        $this->src('data_src')
        ->query("SELECT valor,data FROM frutas")
        ->pipe(new TimeBucket(array(
            "data"=>"month"
        )))
        ->pipe(new Group(array(
            "by"=>"data",
            "sum"=>"valor"
        )))
        ->pipe($this->dataStore('data_store'));
    } 
}
