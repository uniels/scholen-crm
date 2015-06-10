<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "De :attribute moet worden geaccepteerd.",
	"active_url"           => "De waarde van :attribute is geen geldige URL.",
	"after"                => "De waarde van :attribute moet een datum na :date zijn.",
	"alpha"                => "De waarde van :attribute mag alleen letters bevatten.",
	"alpha_dash"           => "De waarde van :attribute mag alleen letters, nummers en strepen bevatten.",
	"alpha_num"            => "De waarde van :attribute mag alleen letters en nummers bevatten.",
	"array"                => "De waarde van :attribute moet een array zijn.",
	"before"               => "De waarde van :attribute moet een datum voor :date zijn.",
	"between"              => [
		"numeric" => "De waarde van :attribute moet liggen tussen :min en :max.",
		"file"    => "De waarde van :attribute moet liggen tussen :min en :max kilobytes.",
		"string"  => "De waarde van :attribute moet liggen tussen :min en :max characters.",
		"array"   => "De waarde van :attribute mag tussen de :min en :max items bevatten.",
	],
	"boolean"              => "De waarde van :attribute moet waar of onwaar zijn.",
	"confirmed"            => "De waarde van :attribute-confirmatie komt niet overeen.",
	"date"                 => "De waarde van :attribute is geen geldige datum.",
	"date_format"          => "De waarde van :attribute komt niet overeen met het formaat :format.",
	"different"            => "De waarde van :attribute en :other moet verschillend zijn.",
	"digits"               => "De waarde van :attribute moet bestaan uit :digits cijfers.",
	"digits_between"       => "De waarde van :attribute moet liggen tussen :min en :max cijfers.",
	"email"                => "De waarde van :attribute moet een geldig mailadres zijn.",
	"filled"               => "De waarde van :attribute-veld is vereist.",
	"exists"               => "De waarde van selected :attribute is ongeldig.",
	"image"                => ":attribute moet een afbeelding zijn.",
	"in"                   => "De waarde van selected :attribute is ongeldig.",
	"integer"              => "De waarde van :attribute moet een integer zijn.",
	"ip"                   => "De waarde van :attribute moet een geldig IP-adres zijn.",
	"max"                  => [
		"numeric" => "De waarde van :attribute mag maximaal :max zijn.",
		"file"    => "De waarde van :attribute mag maximaal :max kilobytes zijn.",
		"string"  => "De lengte van :attribute mag maximaal  :max characters.",
		"array"   => "De waarde van :attribute mag maximaal :max items bevatten.",
	],
	"mimes"                => "De waarde van :attribute moet een bestand zijn met het bestandsformaat type: :values.",
	"min"                  => [
		"numeric" => "De waarde van :attribute moet minimaal :min zijn.",
		"file"    => "De waarde van :attribute moet minimaal :min kilobytes zijn.",
		"string"  => "De waarde van :attribute moet minimaal :min karakters hebben.",
		"array"   => "De waarde van :attribute moet minimaal uit :min bestaan.",
	],
	"not_in"               => "De waarde van de geselecteerde :attribute is ongeldig.",
	"numeric"              => "De waarde van :attribute moet een cijfer zijn.",
	"regex"                => "Het formaat van :attribute is ongeldig.",
	"required"             => "Vul een :attribute in.",
	"required_if"          => "De waarde van :attribute field is vereist als :other is :value.",
	"required_with"        => "De waarde van :attribute field is vereist als :values aanwezig is.",
	"required_with_all"    => "De waarde van :attribute field is vereist als :values aanwezig is.",
	"required_without"     => "De waarde van :attribute field is vereist als :values ontbreken.",
	"required_without_all" => "De waarde van :attribute field is vereist als geen van :values aanwezig is.",
	"same"                 => "De waarde van :attribute en :other moeten overeenkomen.",
	"size"                 => [
		"numeric" => "De grootte van :attribute moet :size zijn.",
		"file"    => "De grootte van :attribute moet :size kilobytes zijn.",
		"string"  => "De lengte van :attribute moet :size karakters zijn.",
		"array"   => "Deze :attribute moet :size items bevatten.",
	],
	"unique"               => "De waarde van :attribute komt al eens voor.",
	"url"                  => "Het formaat voor :attribute is ongeldig.",
	"timezone"             => "De waarde van :attribute moet een geldige zone bevatten.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		//Contactdetails:
		'tel'			=> 'telefoon',
		'mail'			=> 'e-mailadres',

		//Contactlog
		'contactdate'	=> 'datum van contact',
		'outbound'		=> 'richting van het contact',
		'medium'		=> 'communicatiemiddel',
		'summary'		=> 'samenvatting',
		'agreements'	=> 'verslag',	

		//people:
		"firstname" 	=> "voornaam",
		"lastname"		=> "achternaam",

		//users:
		"displayname"	=> "weergavenaam",
		"password"		=> "wachtwoord",
		"username"		=> "gebruikersnaam",

	

	],

];
