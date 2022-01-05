<?php
/**
 * PHP 303 Practical Exam: Object-Oriented Programming
 * 
 * Create a class representing a country.
 * The class must have the following properties:
 *  a. Name
 *  b. Description
 *  c. Start date/year of colonization
 *  d. End date/year of colonization
 * Instantiate 3 countries that colonized the Philippines
 * show the details of these countries and create a method that gives 
 *  the total years that they colonized the Philippines.
 */

/**
 * Class representing a Country
 */
class Country {
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var int $colonization_start year
     */
    private $colonization_start;

    /**
     * @var int $colonization_end year
     */
    private $colonization_end;

    /**
     * Constructor
     * 
     * @param string $name country name
     * @param string $description
     * @param int $colstart start year of colonization
     * @param int $colend end year of colonization
     */
    public function __construct(string $name, string $description, int $colstart, int $colend) {
        $this->name = $name;
        $this->description = $description;

        if($colstart > $colend) {
            // throw error
        }

        $this->colonization_start = $colstart;
        $this->colonization_end = $colend;
    }

    /**
     * Getter function
     * 
     * @param string $prop
     * @return mixed
     */
    public function get(string $prop) {
        if(property_exists($this, $prop)) {
            return $this->{$prop};
        }
        throw new Error('Invalid property: ' . $prop . '. Cannot get property.');
    }

    /**
     * Setter function
     * 
     * @param string $prop
     * @param mixed $value
     */
    public function set(string $prop, $value) {
        if(property_exists($this, $prop)) {
            $this->{$prop} = $value;
        }
        throw new Error('Invalid property: ' . $prop . '. Cannot set property.');
    }

    /**
     * Compute the total years of colonization based on the start and end dates
     * 
     * @return int
     */
    public function colonization_years(): int {
        return $this->colonization_end - $this->colonization_start;
    }
}

// Instances
$spain = new Country('Spain', 'La Piel de Toro (The Bull Skin)', 1565, 1898);
$japan = new Country('Japan', 'Land of the Rising sun', 1942, 1945);
$america = new Country('America', 'Land of Opportunities', 1898, 1946);

// Build output data
$data = [];
$data['spain'] = (object) [
    'name' => $spain->get('name'),
    'description' => $spain->get('description'),
    'from' => $spain->get('colonization_start'),
    'to' => $spain->get('colonization_end'),
    'years' => $spain->colonization_years(),
];
$data['japan'] = (object) [
    'name' => $japan->get('name'),
    'description' => $japan->get('description'),
    'from' => $japan->get('colonization_start'),
    'to' => $japan->get('colonization_end'),
    'years' => $japan->colonization_years(),
];
$data['america'] = (object) [
    'name' => $america->get('name'),
    'description' => $america->get('description'),
    'from' => $america->get('colonization_start'),
    'to' => $america->get('colonization_end'),
    'years' => $america->colonization_years(),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 303 Practical Exam: OOP</title>

    <style>
        html, body {
            font-family: Calibri, sans-serif;
            font-size: 16px;
        }

        table {border-collapse: collapse;}

        table th, table td {
            text-align: left;
            padding: 0.25rem 0.5rem;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div>
        <h1>Philippine Colonizers</h1>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Description</th>
                    <th>From Year</th>
                    <th>To Year</th>
                    <th>Years of colonization</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $item): ?>
                <tr>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->description; ?></td>
                    <td><?php echo $item->from; ?></td>
                    <td><?php echo $item->to; ?></td>
                    <td><?php echo $item->years; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>