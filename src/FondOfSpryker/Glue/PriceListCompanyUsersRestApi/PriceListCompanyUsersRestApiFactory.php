<?php

namespace FondOfSpryker\Glue\PriceListCompanyUsersRestApi;

use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpander;
use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpanderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class PriceListCompanyUsersRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpanderInterface
     */
    public function createPriceListsCompanyUsersResourceRelationshipExpander(): PriceListsCompanyUsersResourceRelationshipExpanderInterface
    {
        return new PriceListsCompanyUsersResourceRelationshipExpander(
            $this->getResourceBuilder()
        );
    }
}
