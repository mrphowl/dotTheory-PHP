<?php
define('COUNTRY_SINGAPORE', 'Singapore');
define('COUNTRY_UNITEDKINGDOM', 'United Kingdom');
define('COUNTRY_CANADA', 'Canada');
define('COUNTRY_FRANCE', 'France');
define('COUNTRY_USA', 'USA');
define('COUNTRY_PHILIPPINES', 'Philippines');

$age = 21;
$country = '';
$vacation = '';

// Determine which country a person should go to at a certain age.
if($age >= 15 and $age <= 18) {
    $country = COUNTRY_SINGAPORE;
} elseif($age == 19) {
    $country = COUNTRY_UNITEDKINGDOM;
} elseif($age >=20 and $age <=23) {
    $country = COUNTRY_CANADA;
}

// Determine which country the person should go on a vacation.
switch($country) {
    case COUNTRY_SINGAPORE:
        $vacation = COUNTRY_FRANCE;
    case COUNTRY_UNITEDKINGDOM:
        $vacation = COUNTRY_USA;
    case COUNTRY_CANADA:
        $vacation = COUNTRY_PHILIPPINES;
}

echo "Age: $age" . PHP_EOL;
echo 'Country: ' . $country . PHP_EOL;
echo 'Vacation: ' . $vacation . PHP_EOL;
?>