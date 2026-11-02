<?php

use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure below is bound to every test in the "Feature" folder, so
| tests can bootstrap the Laravel application and use RefreshDatabase.
|
*/

pest()->extend(TestCase::class)->in('Feature');
