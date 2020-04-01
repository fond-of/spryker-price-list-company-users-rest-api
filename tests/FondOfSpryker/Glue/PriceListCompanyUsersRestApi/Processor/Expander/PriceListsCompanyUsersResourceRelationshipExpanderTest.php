<?php

namespace FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\PriceListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PriceListsCompanyUsersResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\PriceListCompanyUsersRestApi\Processor\Expander\PriceListsCompanyUsersResourceRelationshipExpander
     */
    protected $priceListsCompanyUsersResourceRelationshipExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PriceListTransfer
     */
    protected $priceListTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [
            $this->restResourceInterfaceMock,
        ];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceListTransferMock = $this->getMockBuilder(PriceListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->priceListsCompanyUsersResourceRelationshipExpander = new PriceListsCompanyUsersResourceRelationshipExpander(
            $this->restResourceBuilderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getPriceList')
            ->willReturn($this->priceListTransferMock);

        $this->priceListTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->priceListTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('addRelationship')
            ->willReturnSelf();

        $this->priceListsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsCompanyUserNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn(null);

        $this->priceListsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsCompanyNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn(null);

        $this->priceListsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsPriceListNull(): void
    {
        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getPriceList')
            ->willReturn(null);

        $this->priceListsCompanyUsersResourceRelationshipExpander->addResourceRelationships(
            $this->resources,
            $this->restRequestInterfaceMock
        );
    }
}
