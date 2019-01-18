<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\Resolver;

use Pyz\Client\Search\SearchConfig;
use Pyz\Client\Search\SearchFactory;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;

class SearchResolver
{
    protected $searchFactory;

    public function __construct(SearchFactory $searchFactory)
    {
        $this->searchFactory = $searchFactory;
    }

    /**
     * Resolve here what the handler should be work
     *
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\Search\Model\Handler\SearchHandlerInterface
     */
    public function resolve(QueryInterface $searchQuery, array $requestParameters = []): SearchHandlerInterface
    {
        if (isset($requestParameters[SearchConfig::PARAM_SUGGEST]) && $requestParameters[SearchConfig::PARAM_SUGGEST]) {
            return  $this->searchFactory->createSuggestFactFinderHandler(); // FF
        } else {
            return  $this->searchFactory->createSearchFactFinderHandler(); // FF
        }

        return  $this->searchFactory->createElasticsearchSearchHandler(); // ES
    }

}
