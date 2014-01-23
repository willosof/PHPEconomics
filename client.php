<?

include "class.php";

$e = new ecw();

$r = $e->api("Product_GetData",array(
	"entityHandle" => array(
		"Number" => 1
	)
));


print_r($r);


?>
