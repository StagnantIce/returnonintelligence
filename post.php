<?
session_start();
require('config.php');

if (isset($_POST['input']) && isset($_POST['token'])) {
	if ($_POST['token'] === $_SESSION['token']) {
		try {
			$input=explode(ROW__DELIMITER, $_POST['input']);
			if (count($input) < 3) {
				throw new Exception("Expect minimum 3 rows for input format");
			}

			list($y, $x) = explode(COL_DELIMITER, trim($input[0]), 2);
			$map = new Map($y, $x);

			$series = array_slice($input, 1);
			for($i = 0; $i < count($series); $i+=2) {
				list($position, $route) = array(trim($series[$i]), trim($series[$i+1]));
				$position = explode(COL_DELIMITER, $position);
				$position = Position::fromArray($position);
				$route = new Route(trim($route));
				$map->buildRoute($position, $route);
				echo $position;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	} else {
		echo "Error token";
	}
} else {
	echo "No params";
}