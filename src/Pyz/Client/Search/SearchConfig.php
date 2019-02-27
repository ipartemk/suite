<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search;

use Pyz\Shared\Search\SearchConstants;
use Spryker\Client\Search\SearchConfig as SprykerSearchConfig;

class SearchConfig extends SprykerSearchConfig
{
    public const PARAM_SUGGEST = 'suggest';

    /**
     * @return string
     */
    public function getFactFinderUrl()
    {
        return $this->get(SearchConstants::FACT_FINDER_URL);
    }

    /**
     * @return string
     */
    public function getFactFinderUsername()
    {
        return $this->get(SearchConstants::FACT_FINDER_USERNAME);
    }

    /**
     * @return string
     */
    public function getFactFinderPassword()
    {
        return $this->get(SearchConstants::FACT_FINDER_PASSWORD);
    }

    /**
     * @return string
     */
    public function getFactFinderSearch()
    {
        return $this->get(SearchConstants::FACT_FINDER_PASSWORD);
    }
}
