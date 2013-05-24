<?php

$NAMES[0]="Flicka";
$NAMES[1]="Star";
$NAMES[2]="Dakota";
$NAMES[3]="Cheyenne";
$NAMES[4]="Misty";
$NAMES[5]="Spirit";
$NAMES[6]="Blaze";
$NAMES[7]="Cowboy";
$NAMES[8]="Lucky";
$NAMES[9]="Buddy";
$NAMES[10]="Chief";
$NAMES[11]="Duke";
$NAMES[12]="Gypsy";
$NAMES[13]="Honey";
$NAMES[14]="Lady";
$NAMES[15]="Rocky";
$NAMES[16]="Stormy";
$NAMES[17]="Sugar";
$NAMES[18]="Toby";
$NAMES[19]="Annie";
$NAMES[20]="Coco";
$NAMES[21]="Cocoa";
$NAMES[22]="Dusty";
$NAMES[23]="Jack";
$NAMES[24]="Jake";
$NAMES[25]="Luna";
$NAMES[26]="Magic";
$NAMES[27]="Max";
$NAMES[28]="Rain";
$NAMES[29]="Rusty";
$NAMES[30]="Whisper";
$NAMES[31]="Willow";
$NAMES[32]="Bella";
$NAMES[33]="Bailey";
$NAMES[34]="Billy";
$NAMES[35]="Bo";
$NAMES[36]="Bob";
$NAMES[37]="Brandy";
$NAMES[38]="Buck";
$NAMES[39]="Choco";
$NAMES[40]="Daisy";
$NAMES[41]="Dallas";
$NAMES[42]="Dolly";
$NAMES[43]="Freckles";
$NAMES[44]="Harley";
$NAMES[45]="King";
$NAMES[46]="Maggie";
$NAMES[47]="Midnight";
$NAMES[48]="Milo";
$NAMES[49]="Molly";
$NAMES[50]="Nikki";
$NAMES[51]="Prince";
$NAMES[52]="Ranger";
$NAMES[53]="Red";
$NAMES[54]="Romeo";
$NAMES[55]="Rosie";
$NAMES[56]="Sally";
$NAMES[57]="Scout";
$NAMES[58]="Smokey";
$NAMES[59]="Taz";
$NAMES[60]="Whiskey";
$NAMES[61]="Amber";
$NAMES[62]="Abby";
$NAMES[63]="Annabell";
$NAMES[64]="Apple";
$NAMES[65]="Apollo";
$NAMES[66]="Apache";
$NAMES[67]="Asia";
$NAMES[68]="Badal";
$NAMES[69]="Beauty";
$NAMES[70]="Beast";
$NAMES[71]="Athena";
$NAMES[72]="Belle";
$NAMES[73]="Big red";
$NAMES[74]="Blue";
$NAMES[75]="Bonnie";
$NAMES[76]="Bud";
$NAMES[77]="Buttercup";
$NAMES[78]="Camanchi";
$NAMES[79]="Casey";
$NAMES[80]="Champ";
$NAMES[81]="Chance";
$NAMES[82]="Charger";
$NAMES[83]="Cherokee";
$NAMES[84]="Chester";
$NAMES[85]="Chip";
$NAMES[86]="Colton";
$NAMES[87]="Comet";
$NAMES[88]="Corizon";
$NAMES[89]="Cricket";
$NAMES[90]="Dani";
$NAMES[91]="Dixie";
$NAMES[92]="Dreamer";
$NAMES[93]="Edward";
$NAMES[94]="Elvis";
$NAMES[95]="Emily";
$NAMES[96]="Emma";
$NAMES[97]="Estrellita";
$NAMES[98]="Faith";
$NAMES[99]="Fantasy";




class Horse{
  public $luck;
  public $stamina;
  public $topspeed;
  public $acceleration;
  public $name;
  public $boost;


  public $d;
  public $d_0;
  public $speed;

  public function __construct() {
    global $NAMES;
    $this->luck         = rand(1, 10);
    $this->stamina      = rand(10, 15);
    $this->topspeed     = rand(10, 15);
    $this->acceleration = rand(10, 15);
    $this->name = $NAMES[rand(0,99)];
    $this->d = 0;
    $this->speed = 0;
    $this->cur_acc = 0;
    $this->cur_stamina = $this->stamina;


  }

  public function strength() {
    return $this->luck + $this->stamina + $this->topspeed + $this->acceleration;
  }

  public function tick_update($tick) {
    $roll = rand(1,20);

    if( $roll + $this->cur_stamina >= 25) {
      $this->speed = ($this->d - $this->d_0) + $this->acceleration * $tick;
      $this->cur_stamina -= 1;
    }else if($roll == 1){
      $this->speed = ($this->d - $this->d_0) + $this->acceleration * -1 * $tick;
      $this->cur_stamina = $this->stamina/2;
    }else if($roll + $this->cur_stamina <= 24) {
      $this->speed = $this->speed;
      $this->cur_stamina += .5;
    }


    if($this->cur_stamina >= $this->stamina) {
      $this->cur_stamina = $this->stamina;
    }

    if($this->speed >= $this->topspeed) {
      $this->speed = $this->topspeed;
    }

    if($this->speed <= 0) {
      $this->speed = 0;
    }


    if(  $roll + $this->luck >= 30  ) {
      $this->boost = 1;
      $this->speed += 5;
    }else{
      $this->boost = 0;
    }

    $this->d_0 = $this->d;
    $this->d += $this->speed * $tick;
  }
}

class Race{
  public $length;
  public $tick;
  public $horses;

  public $points;

  public function __construct($length) {
    $this->length = $length;
    $this->tick = 1;


    $this->horses[0] = new Horse();
    while($this->horses[0]->strength() <= 26 ){
      unset($this->horses[0]);
      $this->horses[0] = new Horse();
    }

    $this->horses[1] = new Horse();
    while($this->horses[1]->strength() <= 26 ){
      unset($this->horses[1]);
      $this->horses[1] = new Horse();
    }

    $this->horses[2] = new Horse();
    while($this->horses[2]->strength() <= 26 ){
      unset($this->horses[2]);
      $this->horses[2] = new Horse();
    }


    $this->horses[3] = new Horse();
    while($this->horses[3]->strength() <= 26 ){
      unset($this->horses[3]);
      $this->horses[3] = new Horse();
    }

    $this->horses[4] = new Horse();
    while($this->horses[4]->strength() <= 26 ){
      unset($this->horses[4]);
      $this->horses[4] = new Horse();
    }


  }


  public function reset() {
    $this->horses[0]->boost = 0;
    $this->horses[0]->d = 0;
    $this->horses[0]->speed = 0;
    $this->horses[0]->d_0 = 0;
    $this->horses[0]->cur_acc = 0;
    $this->horses[0]->cur_stamina = $this->horses[0]->stamina;

    $this->horses[1]->boost = 0;
    $this->horses[1]->d = 0;
    $this->horses[1]->speed = 0;
    $this->horses[1]->d_0 = 0;
    $this->horses[1]->cur_acc = 0;
    $this->horses[1]->cur_stamina = $this->horses[1]->stamina;

    $this->horses[2]->boost = 0;
    $this->horses[2]->d = 0;
    $this->horses[2]->speed = 0;
    $this->horses[2]->d_0 = 0;
    $this->horses[2]->cur_acc = 0;
    $this->horses[2]->cur_stamina = $this->horses[2]->stamina;

    $this->horses[3]->boost = 0;
    $this->horses[3]->d = 0;
    $this->horses[3]->speed = 0;
    $this->horses[3]->d_0 = 0;
    $this->horses[3]->cur_acc = 0;
    $this->horses[3]->cur_stamina = $this->horses[3]->stamina;

    $this->horses[4]->boost = 0;
    $this->horses[4]->d = 0;
    $this->horses[4]->speed = 0;
    $this->horses[4]->d_0 = 0;
    $this->horses[4]->cur_acc = 0;
    $this->horses[4]->cur_stamina = $this->horses[4]->stamina;
    $this->tick = 0;
  }

  public function cmp($a, $b) {
    return $a->d < $b->d;
  }

  public function tick() {
    $this->horses[0]->tick_update($this->tick);
    $this->horses[1]->tick_update($this->tick);
    $this->horses[2]->tick_update($this->tick);
    $this->horses[3]->tick_update($this->tick);
    $this->horses[4]->tick_update($this->tick);
    usort($this->horses, array(__CLASS__, 'cmp'));
    $this->tick++;
  }

  public function print_standing() {
    $i = 0;
    echo "===================Tick # " .$this->tick. "==================\n";
    echo "|   Name  |   Distance  |   Speed  | Luck |\n";
    echo "===========================================\n";
    for($i =0; $i < 5; $i++) {
      printf("|");
      printf("%-9s", $this->horses[$i]->name);
      printf("|");
      printf("%-13d", $this->horses[$i]->d);
      printf("|");
      printf("%-10d", $this->horses[$i]->speed);
      printf("|");
      printf("%-6d", $this->horses[$i]->boost);
      printf("|\n");
    }
    echo "===========================================\n";
  }

  public function passed() {
    if($this->horses[0]->d >= $this->length) {
      return 1;
    }else if($this->horses[1]->d >= $this->length) {
      return 1;
    }else if($this->horses[2]->d >= $this->length) {
      return 1;
    }else if($this->horses[3]->d >= $this->length) {
      return 1;
    }else if($this->horses[4]->d >= $this->length) {
      return 1;
    }
    return 0;
  }

  public function start() {
    unset($this->points);
    $this->reset();
    while(!$this->passed()) {
      $this->print_standing();
      $this->tick();
      //fgetc(STDIN);
    }
    $this->points[] = $this->horses[0]->name;
    //$this->points[] = $this->horses[1]->name;
    //$this->points[] = $this->horses[2]->name;
    //$this->points[] = $this->horses[3]->name;
    //$this->points[] = $this->horses[4]->name;
    $this->print_standing();
  }

  public function dump_horses() {
    $i = 0;
    echo "================================Horses===============================\n";
    echo "|   Name  |   Top Speed  |  Stamina  |  Acceleration  | Luck |  Pts |\n";
    echo "=====================================================================\n";
    for($i =0; $i < 5; $i++) {
      printf("|");
      printf("%-9s", $this->horses[$i]->name);
      printf("|");
      printf("%-14d", $this->horses[$i]->topspeed);
      printf("|");
      printf("%-11d", $this->horses[$i]->stamina);
      printf("|");
      printf("%-16d", $this->horses[$i]->acceleration);
      printf("|");
      printf("%-6d", $this->horses[$i]->luck);
      printf("|");
      printf("%-5d", $i);
      printf("|\n");
    }
    echo "=====================================================================\n";
  }
}

class Stats {

  public $race;
  public $num_of_races;
  public $points;

  public function __construct($num_of_races) {
    $this->race = new Race(500);
    $this->num_of_races = $num_of_races;
    $this->points = array();
  }

  public function load_names () {
    $this->points[0][0] = $this->race->horses[0]->name;
    $this->points[1][0] = $this->race->horses[1]->name;
    $this->points[2][0] = $this->race->horses[2]->name;
    $this->points[3][0] = $this->race->horses[3]->name;
    $this->points[4][0] = $this->race->horses[4]->name;
  }

  public function load_points(){
    //$this->points[0][1] += array_search($this->points[0][0], $this->race->points);
    //$this->points[1][1] += array_search($this->points[1][0], $this->race->points);
    //$this->points[2][1] += array_search($this->points[2][0], $this->race->points);
    //$this->points[3][1] += array_search($this->points[3][0], $this->race->points);
    //$this->points[4][1] += array_search($this->points[4][0], $this->race->points);

    for($i = 0; $i < sizeof($this->points); $i++) {
      if($this->race->points[0] == $this->points[$i][0]) {
        $this->points[$i][1] += 1;
        break;
      }

    }

  }

  public function run_stats() {
    $i = 0;
    $this->load_names();
    for($i = 0; $i< $this->num_of_races; $i++) {
      $this->race->start();
      $this->load_points();
      echo "===============NewRace==================\n";
    }
    $this->race->dump_horses();
    $this->print_stats();
  }		

  public function print_stats() {
    $i = 0;
    echo "======Horses======\n";
    echo "|   Name  |  Pts |\n";
    echo "==================\n";
    for($i =0; $i < 5; $i++) {
      printf("|");
      printf("%-9s", $this->points[$i][0]);
      printf("|");
      printf("%-5d", isset($this->points[$i][1]) ? $this->points[$i][1] : 0);
      printf("|\n");
    }
    echo "==================\n";
  }
}



$stats = new Stats(100);
$stats->run_stats();

?>
