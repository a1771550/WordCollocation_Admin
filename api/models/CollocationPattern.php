<?php
/**
 * Created by PhpStorm.
 * User: kevinlau
 * Date: 10/7/16
 * Time: 8:04 AM
 */

namespace api\models;


class CollocationPattern
{
	const NOUN_VERB=1;
	const VERB_NOUN=2;
	const ADJECTIVE_NOUN=3;
	const VERB_PREPOSITION=4;
	/* this 5 is unused, but must not be deleted; otherwise the current examples in the db cannot be shown... */
	const PREPOSITION_VERB=5;
	const ADVERB_VERB=6;
	const PHRASE_NOUN=7;
	const PREPOSITION_NOUN=8;
	const ADJECTIVE_PHRASE=9;
}