<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\ColumnChart;
    use \koolreport\widgets\google\PieChart;
?>

<div class="report-content">
    <h1 class="text-center"><?php echo "Frutas pela data"; ?></h1>

    <?php
    PieChart::create(array(
        "dataStore"=>$this->dataStore('data_store'),  
        "columns"=>array(
            "data"=>array(
                "label"=>"Data",
                "type"=>"datetime",
                "format"=>"Y-n",
                "displayFormat"=>"F, Y",
            ),
            "valor"=>array(
                "label"=>"Valor",
                "type"=>"number",
                "prefix"=>"$",
            )
        ),
        "width"=>"100%",
    ));
    ?>

    <?php
        ColumnChart::create([
            "dataSource"=>$this->dataStore("data_store"),
            "columns"=>[
                "data",
                "valor"=>[
                    "style"=>function($row) {
                        switch($row["data"])
                        {
                            case "2020-05":
                                return "color: #00F";
                            case "2020-06":
                                return "color: #0F0";
                            case "2020-07":
                                return "color: #F00";
                        }
                    }
                ]
            ],
            "width"=>"100%",
        ]);
    ?>

    <?php
    Table::create(array(
        "dataStore"=>$this->dataStore('data_store'),
        "columns"=>array(
            "data" => array(
                "label"=>"Data",
                "type"=>"datetime",
                "format"=>"Y-n",
                "displayFormat"=>"F, Y",
            ),
            "valor"=>array(
                "label"=>"Valor",
                "type"=>"number",
                "prefix"=>"$",
            )
        ),
        "cssClass"=>array(
            "table"=>"table table-hover table-bordered"
        )
    ));
    ?>
</div>

<br>
<hr>
<h3>Título da descrição</h3>
<p>Corpo da descrição do relatório</p>
