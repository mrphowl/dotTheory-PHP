<?php
// Shoe brands
$shoebrands = ['Nike', 'Adidas', 'Puma', 'Converse'];

// Print 3rd brand
echo 'Shoe brands' . PHP_EOL;
print_r($shoebrands);
echo 'The third brand is: ' . $shoebrands[2] . PHP_EOL;
echo PHP_EOL;

// NBA players

$nbaplayers = [
  'Lebron James' => 'Lakers',
  'Derrick Rose' => 'Knicks',
  'Steph Curry' => 'Warriors',
];

// Print Steph Curry's team.
echo 'NBA Players' . PHP_EOL;
print_r($nbaplayers);
echo 'The team of Steph Curry is: ' . $nbaplayers['Steph Curry'] . PHP_EOL;
echo PHP_EOL;

// Fast food chains

$fastfoodchains = [
  'Jollibee' => [
    'Branches' => 12,
    'Managers' => 15,
    'Employees' => 50,
  ],
  'Mcdonalds' => [
    'Branches' => 18,
    'Managers' => 10,
    'Employees' => 70,
  ],
  'KFC' => [
    'Branches' => 8,
    'Managers' => 9,
    'Employees' => 40,
  ],
];

// Print the fast food chain with the least managers and the most employees.
echo 'Fast food chains' . PHP_EOL;
print_r($fastfoodchains);
echo 'The chain with the least managers: ';

if($fastfoodchains['Jollibee']['Managers'] < $fastfoodchains['Mcdonalds']['Managers'] &&
    $fastfoodchains['Jollibee']['Managers'] < $fastfoodchains['KFC']['Managers']) {
  echo 'Jollibee = ' . $fastfoodchains['Jollibee']['Managers'];
} elseif($fastfoodchains['Mcdonalds']['Managers'] < $fastfoodchains['Jollibee']['Managers'] &&
    $fastfoodchains['Mcdonalds']['Managers'] < $fastfoodchains['KFC']['Managers']) {
  echo 'Mcdonalds' . $fastfoodchains['Mcdonalds']['Managers'];
} elseif($fastfoodchains['KFC']['Managers'] < $fastfoodchains['Mcdonalds']['Managers'] &&
    $fastfoodchains['KFC']['Managers'] < $fastfoodchains['Jollibee']['Managers']) {
  echo 'KFC' . $fastfoodchains['KFC']['Managers'];
}

echo PHP_EOL;
echo 'The chain with the most employees: ';

if($fastfoodchains['Jollibee']['Employees'] > $fastfoodchains['Mcdonalds']['Employees'] &&
    $fastfoodchains['Jollibee']['Employees'] > $fastfoodchains['KFC']['Employees']) {
  echo 'Jollibee' . $fastfoodchains['Jollibee']['Managers'];
} elseif($fastfoodchains['Mcdonalds']['Employees'] > $fastfoodchains['Jollibee']['Employees'] &&
    $fastfoodchains['Mcdonalds']['Employees'] > $fastfoodchains['KFC']['Employees']) {
  echo 'Mcdonalds' . $fastfoodchains['Mcdonalds']['Managers'];
} elseif($fastfoodchains['KFC']['Employees'] > $fastfoodchains['Mcdonalds']['Employees'] &&
    $fastfoodchains['KFC']['Employees'] > $fastfoodchains['Jollibee']['Employees']) {
  echo 'KFC' . $fastfoodchains['KFC']['Managers'];
}
echo PHP_EOL;
