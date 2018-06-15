<?php
/**
 * This is what you get when you add a new section
 * to the SECTION array and forgot to create the
 * the section's controller
 */

$this->respond('[*]?', function ($request, $response) {
   return 'This is the default controller';
});