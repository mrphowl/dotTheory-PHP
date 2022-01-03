<?php
$shoebrands = ['Nike', 'Adidas', 'Puma', 'Converse'];

echo $shoebrands[2] . PHP_EOL;

$nbaplayers = [
  'Lebron James' => 'Lakers',
  'Derrick Rose' => 'Knicks',
  'Steph Curry' => 'Warriors',
];

echo $nbaplayers['Steph Curry'] . PHP_EOL;

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

echo 'Least managers: ';

if($fastfoodchains['Jollibee']['Managers'] < $fastfoodchains['Mcdonalds']['Managers'] &&
    $fastfoodchains['Jollibee']['Managers'] < $fastfoodchains['KFC']['Managers']) {
  echo 'Jollibee';
} elseif($fastfoodchains['Mcdonalds']['Managers'] < $fastfoodchains['Jollibee']['Managers'] &&
    $fastfoodchains['Mcdonalds']['Managers'] < $fastfoodchains['KFC']['Managers']) {
  echo 'Mcdonalds';
} elseif($fastfoodchains['KFC']['Managers'] < $fastfoodchains['Mcdonalds']['Managers'] &&
    $fastfoodchains['KFC']['Managers'] < $fastfoodchains['Jollibee']['Managers']) {
  echo 'KFC';
}

echo PHP_EOL;
echo 'Most employees: ';

if($fastfoodchains['Jollibee']['Employees'] > $fastfoodchains['Mcdonalds']['Employees'] &&
    $fastfoodchains['Jollibee']['Employees'] > $fastfoodchains['KFC']['Employees']) {
  echo 'Jollibee';
} elseif($fastfoodchains['Mcdonalds']['Employees'] > $fastfoodchains['Jollibee']['Employees'] &&
    $fastfoodchains['Mcdonalds']['Employees'] > $fastfoodchains['KFC']['Employees']) {
  echo 'Mcdonalds';
} elseif($fastfoodchains['KFC']['Employees'] > $fastfoodchains['Mcdonalds']['Employees'] &&
    $fastfoodchains['KFC']['Employees'] > $fastfoodchains['Jollibee']['Employees']) {
  echo 'KFC';
}
echo PHP_EOL;
