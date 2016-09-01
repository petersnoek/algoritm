<?php 

class Inschrijving {
	public $naam;
	public $voorkeur1;
	public $voorkeur2;
	public $voorkeur3;
	public $voorkeur4;
	public $voorkeur5;

	function __construct($naam, $vk1, $vk2, $vk3, $vk4, $vk5) {
	   	$this->naam = $naam;
	   	$this->voorkeur1 = $vk1;
		$this->voorkeur2 = $vk2;
		$this->voorkeur3 = $vk3;
		$this->voorkeur4 = $vk4;
		$this->voorkeur5 = $vk5;
	}
}

class Activiteit {
	public $naam;
	public $max_ronde1;
	public $max_ronde2;
	public $max_ronde3;
	public $max_ronde4;

	function __construct($naam, $max_ronde1, $max_ronde2, $max_ronde3, $max_ronde4) {
	   	$this->naam = $naam;
	   	$this->max_ronde1 = $max_ronde1;
		$this->max_ronde2 = $max_ronde2;
		$this->max_ronde3 = $max_ronde3;
		$this->max_ronde4 = $max_ronde4;
	}
}

class Rooster {
	public $naam;
	public $ronde1;
	public $ronde2;
	public $ronde3;
	public $ronde4;

	function __construct($naam, $ronde1, $ronde2, $ronde3, $ronde4) {
	   	$this->naam = $naam;
	   	$this->ronde1 = $ronde1;
		$this->ronde2 = $ronde2;
		$this->ronde3 = $ronde3;
		$this->ronde4 = $ronde4;
	}
}

function print_rooster($rooster, $titel) {
	// print de Inschrijvingen
	printf('<h1>%s</h1>', $titel);
	echo '<ul>';
	foreach ($rooster as $r) {
		printf('<li>%s [%s] [%s] [%s] [%s]</li>', $r->naam, $r->ronde1, $r->ronde2, $r->ronde3, $r->ronde4 );
	}
	echo '</ul>';
}

// voorkeuren array
$inschrijvingen = array();
$inschrijvingen[0] = new Inschrijving('Denise Valkenburg', '1. Breakdance', '3. Fitness', 	'19. Dans workshop', 	'16. Zumba/Core training/Aerobics',		'27. Drama workshop');
$inschrijvingen[1] = new Inschrijving('stijn smeets', '10. Casting', '14. Voetbal', '20. Trampoline', '21. Balancebikes','25. Pannakooi');
$inschrijvingen[2] = new Inschrijving('danny rothuizen', '14. Voetbal', '3. Fitness', '10. Casting', '5. Kickboksen','8. Beachvolleybal');
$inschrijvingen[3] = new Inschrijving('Maartje van Weegen', '1. Breakdance', '3. Fitness', 	'19. Dans workshop', 	'16. Zumba/Core training/Aerobics',		'27. Drama workshop');
$inschrijvingen[4] = new Inschrijving('Pieter Groens', '10. Casting', '14. Voetbal', '20. Trampoline', '21. Balancebikes','25. Pannakooi');
$inschrijvingen[5] = new Inschrijving('Thim de Groot', '14. Voetbal', '3. Fitness', '10. Casting', '5. Kickboksen','8. Beachvolleybal');
$inschrijvingen[6] = new Inschrijving('Mike den Besten', '1. Breakdance', '3. Fitness', 	'19. Dans workshop', 	'16. Zumba/Core training/Aerobics',		'27. Drama workshop');
$inschrijvingen[7] = new Inschrijving('stijn smeets', '10. Casting', '14. Voetbal', '20. Trampoline', '21. Balancebikes','25. Pannakooi');
$inschrijvingen[8] = new Inschrijving('danny rothuizen', '14. Voetbal', '3. Fitness', '10. Casting', '5. Kickboksen','8. Beachvolleybal');

// maak capaciteiten:  naam, capaciteit-ronde-1, capaciteit-ronde-2, capaciteit-ronde-3, capaciteit-ronde-4
$activiteiten = array();
$activiteiten[0] = new Activiteit('10. Casting', 2, 1, 1, 0);
$activiteiten[1] = new Activiteit('14. Voetbal', 1, 0, 24, 0);
$activiteiten[2] = new Activiteit('1. Breakdance', 1, 10, 10, 0);
$activiteiten[3] = new Activiteit('20. Trampoline', 1, 1, 1, 0);
$activiteiten[4] = new Activiteit('3. Fitness', 1, 10, 10, 0);


// print de Inschrijvingen
echo '<h1>Inschrijvingen</h1>';
echo '<ul>';
foreach ($inschrijvingen as $i) {
	printf('<li>%s [%s] [%s] [%s] [%s] [%s]</li>', $i->naam, $i->voorkeur1, $i->voorkeur2, $i->voorkeur3, $i->voorkeur4, $i->voorkeur5 );
}
echo '</ul>';

// print de Activeiten
echo '<h1>Activiteiten</h1>';
echo '<ul>';
foreach ($activiteiten as $a) {
	printf('<li>%s [%s] [%s] [%s] [%s]</li>', $a->naam, $a->max_ronde1, $a->max_ronde2, $a->max_ronde3, $a->max_ronde4 );
}
echo '</ul>';


// algoritme 1: plan voor elke deelnemer zijn/haar voorkeur 1 in ronde 1
$rooster = array();
foreach ($inschrijvingen as $i) { 
	$rooster[] = new Rooster($i->naam, $i->voorkeur1, '', '', '') ;
}
print_rooster($rooster, 'Rooster na algoritme 1');


// algoritme 2: plan voor elke deelnemer zijn/haar voorkeur 1 in ronde 1.
// hou rekening met maximale capaciteit per activiteit.
// als het niet past geef dan "nog mogelijk" weer als activiteit.
// naam, geplande activiteit in ronde 1
$rooster = array();

function ZoekMaxVoorActiviteit($activiteiten, $gezochte_activiteit) {
	$result = 0;
	foreach ($activiteiten as $activiteit) {
		if ($activiteit->naam == $gezochte_activiteit) $result = $activiteit->max_ronde1;
	}
	return $result;
}

function ZoekHuidigVoorActiviteit($rooster, $gezochte_activiteit) {
	$aantal = 0;
	foreach ($rooster as $r) {
		$activiteit = $r->ronde1;
		if ( $activiteit === $gezochte_activiteit ) $aantal = $aantal + 1;
	}	
	return $aantal;
}

foreach ($inschrijvingen as $inschrijving) { 
	// maximaal mogelijk aantal in ronde 1
	$activiteit = $inschrijving->voorkeur1;
	$max_aantal = ZoekMaxVoorActiviteit($activiteiten, $activiteit );
	$huidig_aantal = ZoekHuidigVoorActiviteit($rooster, $activiteit);
	if ( $huidig_aantal >= $max_aantal) $activiteit = "(" . $activiteit . " is vol; max " . $max_aantal . ")"; 
	$rooster[] = new Rooster( $inschrijving->naam, $activiteit, '', '', '' );
}
print_rooster($rooster, 'Rooster na algoritme 2');




