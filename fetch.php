<?php
    session_start();
    $port = $_GET['pnr'];
    $_SESSION['port'] = $port;
    $name = $_GET['nam'];
    $_SESSION['name'] = $name;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cirrus Dashboard</title>
        <meta charset="UTF-8">
        <meta name="description" content="RRDash is an open source dashboard for rrdtool.">
        <meta name="author" content="RRDash">
        <link rel="stylesheet" href="static/css/bootstrap.min.css">
    </head>
    <body>

        <form method="post">
            <label for="port">Port: </label>
            <input type="text" id="port" name="port" value=<?php echo $port ?>>
            <input type="submit" name="refresh" class="btn btn-primary" value="Download RRD file" />
            <input type="submit" name="setport" class="btn btn-primary" value="Set controller" />
            <a href="index.php" class="btn btn-primary">Back to dashboard</a>
        </form>

        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['refresh'])) {
                $port = $_POST['port'];
                if ($port) {
                    echo "Port set to " . $port;
                    refresh();
                } else {
                    echo "Port empty";
                }
            }

            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['setport'])) {
                $port = $_POST['port'];
                if ($port) {
                    if (!file_exists("/var/www/html/rrd/sensors".$port.".rrd")) {
                        echo "File not available. Download new RRD file.";
                    }
                    # echo shell_exec("ln -sf /var/www/html/rrd/sensors".$port.".rrd /var/www/html/rrd/sensors.rrd");
                } else {
                    echo "Port empty";
                }
            }

        ?>

        <?php
        function refresh() {
            $host = "161.35.73.10";
            $port = $_POST['port'];
            $username = "cirrus";
            $password = "cirrusled";
            $connection = NULL;
            $remote_file_path = "/var/log/sensors.rrd";
            $local_file_path = "/var/www/html/rrd/sensors.rrd";
            echo "Attempting to get file from " . $port;
            try {
            $connection = ssh2_connect($host, $port);
            if(!$connection){
                throw new \Exception("Could not connect to $host on port $port");
            }
            $auth  = ssh2_auth_password($connection, $username, $password);
            if(!$auth){
                throw new \Exception("Could not authenticate with username $username and password ");  
            }
            $sftp = ssh2_sftp($connection);
            if(!$sftp){
                throw new \Exception("Could not initialize SFTP subsystem.");  
            }
            if(ssh2_scp_recv($connection, $remote_file_path, $local_file_path)) {
                echo "File Download Success";
            } else {
                echo "File Download Failed";
            }
            $connection = NULL;
            } catch (Exception $e) {
            echo "Error due to :".$e->getMessage();
            }
            $chmod($local_file_path, 0777);
        }
        ?>
    </body>
</html>