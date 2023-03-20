<?php

use Amadeo\Helper;
use Amadeo\Site;

function ct(): Site {
	return Site::getInstance();
}

function cth(): Helper {
	return Helper::getInstance();
}
