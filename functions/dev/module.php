<?php

namespace Amadeo\Dev;

if ( class_exists( 'WP_CLI' ) ) {
	require_once __DIR__ . '/Main.php';

	require_once __DIR__ . '/Create_Pages.php';
	( new Create_Pages() )->registration_commands();
}
