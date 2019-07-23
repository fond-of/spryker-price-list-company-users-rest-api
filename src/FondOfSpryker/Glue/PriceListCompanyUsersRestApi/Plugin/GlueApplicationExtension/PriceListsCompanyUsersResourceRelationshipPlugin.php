<?php

namespace FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Plugin\GlueApplicationExtension;

use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiFactory getFactory()
 */
class PriceListsCompanyUsersResourceRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     * @api
     *
     * {@inheritdoc}
     *
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        $this->getFactory()->createPriceListsCompanyUsersResourceRelationshipExpander()
            ->addResourceRelationships($resources, $restRequest);
    }

    /**
     * @return string
     * @api
     *
     * {@inheritdoc}
     *
     */
    public function getRelationshipResourceType(): string
    {
        return PriceListCompanyUsersRestApiConfig::RESOURCE_PRICE_LISTS;
    }
}
