<?php

namespace FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander;

use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiConfig;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestPriceListAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PriceListsCompanyUsersResourceRelationshipExpander implements PriceListsCompanyUsersResourceRelationshipExpanderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder)
    {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        foreach ($resources as $resource) {
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CompanyUserTransfer)) {
                continue;
            }

            $companyTransfer = $payload->getCompany();

            if ($companyTransfer === null) {
                continue;
            }

            $priceListTransfer = $companyTransfer->getPriceList();

            if ($priceListTransfer === null) {
                continue;
            }

            $restPriceListAttributesTransfer = (new RestPriceListAttributesTransfer())->fromArray(
                $priceListTransfer->toArray(),
                true
            );

            $priceListResource = $this->restResourceBuilder->createRestResource(
                PriceListCompanyUsersRestApiConfig::RESOURCE_PRICE_LISTS,
                $priceListTransfer->getUuid(),
                $restPriceListAttributesTransfer
            );

            $resource->addRelationship($priceListResource);
        }
    }
}
