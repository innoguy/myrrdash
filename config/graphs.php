<?php

    /*
    Here you need to specify the rrdtool binary path in the system. You may use
    simply "rrdtool" and it will be searched in the PATH variable, but it is
    recommended for security reasons to set the full path, starting with the
    root directory (/).
    */
    $RRDToolPath = "/usr/bin/rrdtool";

    /* Defines */
    /*
    Here you can define constants that you may see repeated throughout the graph
    commands. For example, you may want to define the location of the RRD files
    on your system, so you don't have to type it again, or the height and width
    of the graphs, so they can be changed from a single place, or the watermark
    in the end of your files. Make sure all defines start with RRD_ to ensure
    they are not used anywhere else in the RRDash code.
    */
    define("RRD_PATH", "./rrd/sensors.rrd");
    define("RRD_DIMENSIONS", "-D -w 1200 -h 400");
    define("RRD_CONSTANTS", "-E");

    /*
    The Graphs array contains all graphs that will be generated with rrdtool. Each
    graph must be assigned a unique ID. This unique ID will be used by RRDash
    internally, and will not be exposed to the user through the UI. The contents
    of each ID are the parameters that will be passed to rrdtool for graph generation.
    You can use the constants defined above, but each graph has its own needs. Things
    that usually go here can be the Title, Y-Axis Label, as well, of course, as the
    actual data. All data here will be passed to a shell, so it will be executed as
    code. BE VERY CAREFUL OF THE CONTENT OF THE LINES BELOW.
     */

    define("CPU_LOAD", "DEF:cpu_load=" . RRD_PATH . ":cpu_load:AVERAGE LINE1:cpu_load#ff0000:\"CPU load\"");
    define("CPU_TEMP", "DEF:cpu_temp=" . RRD_PATH . ":cpu_temp:AVERAGE LINE1:cpu_temp#00ff00:\"CPU temp\"");
    define("SSD_TEMP", "DEF:ssd_temp=" . RRD_PATH . ":ssd_temp:AVERAGE LINE1:ssd_temp#552200:\"SSD temp\"");
    define("SSD_READ", "DEF:ssd_read=" . RRD_PATH . ":ssd_read:AVERAGE LINE1:ssd_read#0000ff:\"SSD read\"");
    define("SSD_WRITE","DEF:ssd_write=" . RRD_PATH . ":ssd_write:AVERAGE LINE1:ssd_write#00ffff:\"SSD write\"");
    
    define("APP1_CPU", "DEF:app1_cpu=" . RRD_PATH . ":app1_cpu:AVERAGE LINE1:app1_cpu#ff0000:\"Nucleus\"");
    define("APP2_CPU", "DEF:app2_cpu=" . RRD_PATH . ":app2_cpu:AVERAGE LINE1:app2_cpu#00ff00:\"Player\"");
    define("APP3_CPU", "DEF:app3_cpu=" . RRD_PATH . ":app3_cpu:AVERAGE LINE1:app3_cpu#0000ff:\"AnyDesk\"");
    define("APP4_CPU", "DEF:app4_cpu=" . RRD_PATH . ":app4_cpu:AVERAGE LINE1:app4_cpu#ffff00:\"TeamViewer\"");

    define("APP1_MEM", "DEF:app1_mem=" . RRD_PATH . ":app1_mem:AVERAGE LINE1:app1_mem#ff0000:\"Nucleus\"");
    define("APP2_MEM", "DEF:app2_mem=" . RRD_PATH . ":app2_mem:AVERAGE LINE1:app2_mem#00ff00:\"Player\"");
    define("APP3_MEM", "DEF:app3_mem=" . RRD_PATH . ":app3_mem:AVERAGE LINE1:app3_mem#0000ff:\"AnyDesk\"");
    define("APP4_MEM", "DEF:app4_mem=" . RRD_PATH . ":app4_mem:AVERAGE LINE1:app4_mem#ffff00:\"TeamViewer\"");
    
    define("NET_CEL", "DEF:net_cel=" . RRD_PATH . ":net_cel:AVERAGE LINE1:net_cel#ff0000:\"Cellular \"");
    define("NET_WIF", "DEF:net_wif=" . RRD_PATH . ":net_wif:AVERAGE LINE1:net_wif#00ff00:\"Wifi \"");
    define("NET_ETH", "DEF:net_eth=" . RRD_PATH . ":net_eth:AVERAGE LINE1:net_eth#0000ff:\"Ethernet \"");

    $Graphs = array(
        "cpu_load" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"CPU load\" " . CPU_LOAD , 
        "temperature" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"Temperature\" " . CPU_TEMP . " " . SSD_TEMP, 
        "ssd_io" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"SSD IO \" " . SSD_READ . " " . SSD_WRITE , 
        "app_cpu" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"APP CPU \" " . APP1_CPU . " " . APP2_CPU . " " . APP3_CPU . " " . APP4_CPU, 
        "app_mem" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"APP MEM \" " . APP1_MEM . " " . APP2_MEM . " " . APP3_MEM . " " . APP4_MEM, 
        "net_cel" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET CEL \" " . NET_CEL , 
        "net_wif" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET WIF \" " . NET_WIF , 
        "net_eth" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET ETH \" " . NET_ETH , 
    );

?>
