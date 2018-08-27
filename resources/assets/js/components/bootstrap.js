
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the Spark components which makes up the core client
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */

require('./../spark-components/bootstrap');

require('./home');


require('./settings/team/update-team-profile-details');
require('./settings/user/update-profile-details');
require('./settings/user/update-settings-preferences');

// Configuration
require('./settings/team/create-type-team-configuration');
require('./settings/team/race-team-configuration');
require('./settings/team/color-team-configuration');

// ANIMALS ADOPTIONS

