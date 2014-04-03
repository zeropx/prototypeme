<?php

// Require this file because its what makes the app talk
require_once "app/app.php";


/*
  Build our site
*/
$page = get_page();
// Include HTML head from a partial
partial('_header');

// Print content of page
print $page;

// Include FOOTER from a partial
partial('_footer');

