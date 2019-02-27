<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\Search;

use Spryker\Shared\Search\SearchConstants as SprykerSearchConstants;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface SearchConstants extends SprykerSearchConstants
{
    public const FACT_FINDER_URL = 'FACT_FINDER_URL';

    public const FACT_FINDER_USERNAME = 'FACT_FINDER_USERNAME';
    public const FACT_FINDER_PASSWORD = 'FACT_FINDER_PASSWORD';

    public const FACT_FINDER_SEARCH = 'FACT_FINDER_SEARCH';
    public const FACT_FINDER_SUGGEST = 'FACT_FINDER_SUGGEST';
}
