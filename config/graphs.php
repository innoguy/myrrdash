<?php
    session_start();

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
    define("RRD1_PATH", "./rrd/sensors".$_SESSION['port'].".rrd");
    define("RRD2_PATH", "./rrd/panels".$_SESSION['port'].".rrd");

    define("RRD_DIMENSIONS", "-D -w 1200 -h 400");
    define("RRD_CONSTANTS", "-E");
    define("STYLE", "--color CANVAS#181B1F --color BACK#111217 --color FONT#CCCCDC " );
    $COLORS = array("#ff0000", "#00ff00", "#0000ff", "#fff700", "#ef843c", "#1f78c1", "#a05da0", "#a01da0");

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

    define("CPU_LOAD",  STYLE . "DEF:cpu_load=" . RRD1_PATH . ":cpu_load:AVERAGE LINE1:cpu_load#ff0000:\"CPU load\"");
    define("CPU_TEMP",  STYLE . "DEF:cpu_temp=" . RRD1_PATH . ":cpu_temp:AVERAGE LINE1:cpu_temp#00ff00:\"CPU temp\"");
    define("SSD_TEMP",  STYLE . "DEF:ssd_temp=" . RRD1_PATH . ":ssd_temp:AVERAGE LINE1:ssd_temp#ff0000:\"SSD temp\"");
    define("SSD_READ",  STYLE . "DEF:ssd_read=" . RRD1_PATH . ":ssd_read:AVERAGE LINE1:ssd_read#0000ff:\"SSD read\"");
    define("SSD_WRITE", STYLE . "DEF:ssd_write=" . RRD1_PATH . ":ssd_write:AVERAGE LINE1:ssd_write#00ffff:\"SSD write\"");
    
    define("APP1_CPU", STYLE . "DEF:app1_cpu=" . RRD1_PATH . ":app1_cpu:AVERAGE LINE1:app1_cpu#ff0000:\"Nucleus\"");
    define("APP2_CPU", STYLE . "DEF:app2_cpu=" . RRD1_PATH . ":app2_cpu:AVERAGE LINE1:app2_cpu#00ff00:\"Player\"");
    define("APP3_CPU", STYLE . "DEF:app3_cpu=" . RRD1_PATH . ":app3_cpu:AVERAGE LINE1:app3_cpu#0000ff:\"AnyDesk\"");
    define("APP4_CPU", STYLE . "DEF:app4_cpu=" . RRD1_PATH . ":app4_cpu:AVERAGE LINE1:app4_cpu#ffff00:\"TeamViewer\"");

    define("APP1_MEM", STYLE . "DEF:app1_mem=" . RRD1_PATH . ":app1_mem:AVERAGE LINE1:app1_mem#ff0000:\"Nucleus\"");
    define("APP2_MEM", STYLE . "DEF:app2_mem=" . RRD1_PATH . ":app2_mem:AVERAGE LINE1:app2_mem#00ff00:\"Player\"");
    define("APP3_MEM", STYLE . "DEF:app3_mem=" . RRD1_PATH . ":app3_mem:AVERAGE LINE1:app3_mem#0000ff:\"AnyDesk\"");
    define("APP4_MEM", STYLE . "DEF:app4_mem=" . RRD1_PATH . ":app4_mem:AVERAGE LINE1:app4_mem#ffff00:\"TeamViewer\"");
    
    define("NET_CEL", STYLE . "DEF:net_cel=" . RRD1_PATH . ":net_cel:AVERAGE LINE1:net_cel#ff0000:\"Cellular \"");
    define("NET_WIF", STYLE . "DEF:net_wif=" . RRD1_PATH . ":net_wif:AVERAGE LINE1:net_wif#00ff00:\"Wifi \"");
    define("NET_ETH", STYLE . "DEF:net_eth=" . RRD1_PATH . ":net_eth:AVERAGE LINE1:net_eth#0000ff:\"Ethernet \"");

    define("A_NBR",   STYLE . "DEF:A_nbr="  . RRD2_PATH . ":A_nbr:AVERAGE LINE1:A_nbr#0000ff:\"A nbr \"");
    define("A_TEMP",  STYLE . "DEF:A_temp=" . RRD2_PATH . ":A_temp:AVERAGE LINE1:A_temp#ff0000:\"A tmp \"");
    define("A_FPS",   STYLE . "DEF:A_fps="  . RRD2_PATH . ":A_fps:AVERAGE LINE1:A_fps#00ff00:\"A fps \"");
    define("A_IFC",   STYLE . "DEF:A_ifc="  . RRD2_PATH . ":A_ifc:AVERAGE LINE1:A_ifc#00ffff:\"A ifc \"");

    define("B_NBR",   STYLE . "DEF:B_nbr="  . RRD2_PATH . ":B_nbr:AVERAGE LINE1:B_nbr#0000ff:\"B nbr \"");
    define("B_TEMP",  STYLE . "DEF:B_temp=" . RRD2_PATH . ":B_temp:AVERAGE LINE1:B_temp#ff0000:\"B tmp \"");
    define("B_FPS",   STYLE . "DEF:B_fps="  . RRD2_PATH . ":B_fps:AVERAGE LINE1:B_fps#00ff00:\"B fps \"");
    define("B_IFC",   STYLE . "DEF:B_ifc="  . RRD2_PATH . ":B_ifc:AVERAGE LINE1:B_ifc#00ffff:\"B ifc \"");

    $Graphs = array(
        "cpu_load" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"CPU load\" " . CPU_LOAD , 
        "temperature" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"Temperature\" " . CPU_TEMP . " " . SSD_TEMP, 
        "ssd_io" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"SSD IO \" " . SSD_READ . " " . SSD_WRITE , 
        "app_cpu" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"APP CPU \" " . APP1_CPU . " " . APP2_CPU . " " . APP3_CPU . " " . APP4_CPU, 
        "app_mem" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"APP MEM \" " . APP1_MEM . " " . APP2_MEM . " " . APP3_MEM . " " . APP4_MEM, 
        "net_cel" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET CEL \" " . NET_CEL , 
        "net_wif" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET WIF \" " . NET_WIF , 
        "net_eth" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"NET ETH \" " . NET_ETH , 
        "pan_A" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"PAN A \" " . A_NBR . " " . A_TEMP . " " . A_FPS . " " . A_IFC , 
        "pan_B" => RRD_DIMENSIONS . " " . RRD_CONSTANTS . " -t \"PAN B \" " . B_NBR . " " . B_TEMP . " " . B_FPS . " " . B_IFC , 
    );

?>
