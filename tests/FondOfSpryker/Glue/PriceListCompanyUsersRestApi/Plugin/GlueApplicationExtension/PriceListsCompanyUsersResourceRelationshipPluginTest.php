<?php

namespace FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiConfig;
use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiFactory;
use FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class PriceListsCompanyUsersResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Plugin\GlueApplicationExtension\PriceListsCompanyUsersResourceRelationshipPlugin
     */
    protected $priceListsCompanyUsersResourceRelationshipPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiFactory
     */
    protected $priceListCompanyUsersRestApiFactoryMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpanderInterface
     */
    protected $priceListsCompanyUsersResourceRelationshipExpanderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->priceListCompanyUsersRestApiFactoryMock = $this->getMockBuilder(PriceListCompanyUsersRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceListsCompanyUsersResourceRelationshipExpanderInterfaceMock = $this->getMockBuilder(PriceListsCompanyUsersResourceRelationshipExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceListsCompanyUsersResourceRelationshipPlugin = new class (
            $this->priceListCompanyUsersRestApiFactoryMock
        ) extends PriceListsCompanyUsersResourceRelationshipPlugin {
            /**
             * @var \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiFactory
             */
            protected $priceListCompanyUsersRestApiFactory;

            /**
             * @param \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\PriceListCompanyUsersRestApiFactory $priceListCompanyUsersRestApiFactory
             */
            public function __construct(PriceListCompanyUsersRestApiFactory $priceListCompanyUsersRestApiFactory)
            {
                $this->priceListCompanyUsersRestApiFactory = $priceListCompanyUsersRestApiFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->priceListCompanyUsersRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->priceListCompanyUsersRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createPriceListsCompanyUsersResourceRelationshipExpander')
            ->willReturn($this->priceListsCompanyUsersResourceRelationshipExpanderInterfaceMock);

        $this->priceListsCompanyUsersResourceRelationshipPlugin->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        $this->assertSame(
            PriceListCompanyUsersRestApiConfig::RESOURCE_PRICE_LISTS,
            $this->priceListsCompanyUsersResourceRelationshipPlugin->getRelationshipResourceType()
        );
    }
}
