<?php

    /*
    Specify here all the categories you want to appear in the left-hand column. For each
    category you need to supply a unique ID that will be used internally by RRDash to refer
    to it. This ID will only show in the URL, as a GET parameter. For each category you
    need to specify the name that will appear, as well as the graphs that will be visible.
    */
    $Categories = array(
        "system" => array(
            "name" => "System Loading",
            "graphs" => array("cpu_load", "temperature", "ssd_io"),
        ),
        "applications" => array(
            "name" => "Applications",
            "graphs" => array("app_cpu", "app_mem"),
        ), 
        "network" => array(
            "name" => "Network",
            "graphs" => array("net_cel", "net_wif", "net_eth"),
        ), 
        "combined" => array(
            "name" => "Combined",
            "graphs" => array("system"),
        )
    );

    /*
    DefaultCategory is the ID of the category that will be visible initially, when RRDash
    is loaded.
    */
    $DefaultCategory = "system";
?>
