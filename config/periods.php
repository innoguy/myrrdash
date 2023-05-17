<?php
    session_start();
    /*
    Specify here all the time periods that will be available from within RRDash.
    Each period must have a unique key, that will be used by RRDash to refer to it.
    This key is not visible anywhere, except from the URL. Each period must contain
    a from, as well as a to, which can be UNIX timestamps, or, if preceded by the
    "-" sign, relative to the current time. It is recommended to set the to value
    to a single RRD period, so the last part of the graph will not be empty if the
    graph is queried between two periods. Finally, the name value is the name that
    will appear in the "Time Period" menu of RRDash.
    */
    $TimePeriods = array (
        "hour"  => array( "from" => "-3600",        "to" => "-30",      "name" => "One Hour"  ),
        "2hrs"  => array( "from" => "-7200",        "to" => "-30",      "name" => "Two Hours"  ),
        "3hrs"  => array( "from" => "-10800",       "to" => "-30",      "name" => "Three Hours"  ),
        "6hrs"  => array( "from" => "-21600",       "to" => "-30",      "name" => "Six Hours" ),
        "day"   => array( "from" => "-86400",       "to" => "-30",      "name" => "Today"   ),
        "day_1" => array( "from" => "-172800",      "to" => "-86400",   "name" => "Yesterday"   ),
        "2days" => array( "from" => "-172800",      "to" => "-30",      "name" => "Past 2 Days"   ),
        "3days" => array( "from" => "-259200",      "to" => "-30",      "name" => "Past 3 Days"   ),
        "week"  => array( "from" => "-604800",      "to" => "-30",      "name" => "This Week"  ),
        "month" => array( "from" => "-2592000",     "to" => "-30",      "name" => "This Month" ),
    );

    /*
    DefaultTimePeriod is the ID of the default time period that will load initially,
    as well as be selected when the "Default" option is clicked in the "Time Period"
    menu of RRDash.
    */
    $DefaultTimePeriod = "day";
?>
