<?php

    /*!
	 * POCKET v3.4
	 *
	 * http://www.droidoxy.com
	 * support@droidoxy.com
	 *
	 * Copyright 2019 DroidOXY ( http://www.droidoxy.com )
	 */

header("Content-type: application/json; charset=utf-8");
$numFunc = new functions($dbo);
if(!$numFunc->getConfig('ADMIN')){ api::printError(999, ""); }
