<?php
require_once 'classes/DeviceManager.php';
$devman = new DeviceManager();

$devices = $devman->getDevices();
?>

<!-- Dropdown list of devices -->
<div class="devices">
    <form id="dropdown" name="dropdown" method="post" action="">
        <select name="dropdown" onchange='this.form.submit()'>
            <option value=''>Veldu búnað úr listanum</option>
            <?php   
                //Populate dropdown list with device id's        
                foreach ($devices as $device) {
                    $dev = $device['device_id'];    
                    //echo "<a href='device.php?device_id=$dev'>".$dev."</a><br>";  
                    echo "<option value='".$dev."''>".$dev."</option>";
                }
            ?>
        </select>
        <noscript><input type="submit" value="Submit"></noscript>
    </form>  
</div>

<div class="deviceinfo">
    <?php
        if(isset($_POST['dropdown'])) {
            echo "<h2>".$_POST['dropdown']."</h2>";
            $seldev = $_POST['dropdown']; //selected device
        }
    ?>
    <div id='json_data'>
        <?php
            $data = $devman->getData($seldev);
            echo $data;
        ?>
    </div>
</div>
<canvas id="canvas" height="450" width="960"></canvas>
<div>
    <div class='button' id="btn_kwh">
        KWh
    </div>
    <div class='button'id="btn_amp">
        Amp
    </div>
</div>
<script src='js/mainChart.js'></script>
