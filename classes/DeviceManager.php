<?php //compiles devices registered to user's email address to an array
class DeviceManager
{

	private $updateInterval = 600; // time between updates is 10 minutes.

	public function getDevices() {
		$email = $_SESSION['email'];

		$db;
		try {
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			$this->errorMessages[] = 'Connection failed: ' . $e->getMessage();
		}

		$stm = $db->prepare("SELECT device_id 
				from orka.devices, orka.users 
				where email = '$email' 
				and email = assc_user_email");
		$stm->bindParam(':email', $email, PDO::PARAM_STR);
		$stm->execute();

		$res = $stm->fetchAll();

		return $res;
	}
	/*
		This function returns a json formatted string with the data from a device

		$deviceID - [string] ID for the device you want to get data from
		$end -- [DateTime string](optional) the end date for your query
		$range - [int](optional) the range of your query in days.
	*/
	public function getData($deviceID, $end = "now", $range = 7)
	{
		try {
			$end = new DateTime($end);
			$endTimestamp = $end->getTimestamp();
			$start = $end->sub(new DateInterval('P'.$range.'D'));
			$startTimestamp = $start->getTimestamp();

			$db = new PDO('mysql:host='.DB_HOST.';charset=utf8', DB_USER, DB_PASS);
			$stm = $db->prepare("SELECT * FROM orka.".$deviceID." WHERE timestamp BETWEEN :start AND :end");
			$stm->bindParam(':start', $startTimestamp, PDO::PARAM_INT);
			$stm->bindParam(':end', $endTimestamp, PDO::PARAM_INT);
			$stm->execute();
			$result = $stm->fetchAll();
			
			$labels = $KWhPerDay = $avgAmp = $avgVolt = array();
			$watts = 0; 
			$amps = 0; 
			$volts = 0;
			$resultLen = count($result);
			$updatesPerDay = 86400 / $this->updateInterval;
			for ($i = 0; $i < $resultLen; $i++) {
				if (($i + 1) % $updatesPerDay != 0) {
					$v = floatval($result[$i]['volt']);
					$a = floatval($result[$i]['amp']);
					$watts += $v * $a;
					$amps += $a;
					$volts += $v; 
				} else {
					$labels[] = $result[$i]['timestamp'];
					$KWhPerDay[] = $watts/$range/1000;
					$avgAmp[] = $amps/$range;
					$avgVolt[] = $volts/$range;
					$watts = $amps = $volts = 0.0;
				}
			}
			$str = json_encode(array('labels' => $labels,
									 'KWhPerDay' => $KWhPerDay,
									 'avgAmpsPerday' => $avgAmp,
									 'avgVoltPerDay' => $avgVolt));
			return $str;
		} catch(Exception $e) {
			echo "<pre>exception: ".$e."</pre>";
		}
	}
}
?>