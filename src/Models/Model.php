<?php

namespace Waterhole\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * Base class for a Waterhole Eloquent model.
 *
 * Waterhole Models are unguarded by default. The preferred convention to
 * keep the application secure is to ensure all data is validated (often via
 * the `ValidatesData` trait) prior to filling.
 */
abstract class Model extends Eloquent
{
    use PowerJoins;

    protected static $unguarded = true;
}
