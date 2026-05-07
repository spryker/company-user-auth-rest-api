<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyUserAuthRestApi\Api\Storefront\ApiPlatform\Processor;

use Generated\Api\Storefront\CompanyUserAccessTokensStorefrontResource;
use Generated\Shared\Transfer\OauthRequestTransfer;
use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\ApiPlatform\State\Processor\AbstractStorefrontProcessor;
use Spryker\Client\Oauth\OauthClientInterface;
use Spryker\Glue\CompanyUserAuthRestApi\CompanyUserAuthRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class CompanyUserAccessTokensStorefrontProcessor extends AbstractStorefrontProcessor
{
    public function __construct(protected OauthClientInterface $oauthClient)
    {
    }

    protected function processPost(mixed $data): mixed
    {
        return $this->processCompanyUserAccessTokensGrant($data);
    }

    protected function processCompanyUserAccessTokensGrant(CompanyUserAccessTokensStorefrontResource $resource): CompanyUserAccessTokensStorefrontResource
    {
        if (!$this->hasCustomer()) {
            throw new GlueApiException(Response::HTTP_UNAUTHORIZED, CompanyUserAuthRestApiConfig::RESPONSE_CODE_INVALID_LOGIN, CompanyUserAuthRestApiConfig::RESPONSE_DETAIL_INVALID_LOGIN);
        }

        $oauthRequestTransfer = (new OauthRequestTransfer())
            ->setIdCompanyUser($resource->idCompanyUser)
            ->setCustomerReference($this->getCustomerReference())
            ->setGrantType(CompanyUserAuthRestApiConfig::CLIENT_GRANT_USER);

        $oauthResponseTransfer = $this->oauthClient->processAccessTokenRequest($oauthRequestTransfer);

        if (!$oauthResponseTransfer->getIsValid()) {
            throw new GlueApiException(Response::HTTP_UNAUTHORIZED, CompanyUserAuthRestApiConfig::RESPONSE_CODE_INVALID_LOGIN, CompanyUserAuthRestApiConfig::RESPONSE_DETAIL_INVALID_LOGIN);
        }

        $resource->tokenType = $oauthResponseTransfer->getTokenType();
        $resource->expiresIn = $oauthResponseTransfer->getExpiresIn();
        $resource->accessToken = $oauthResponseTransfer->getAccessToken();
        $resource->refreshToken = $oauthResponseTransfer->getRefreshToken();
        $resource->companyUserAccessTokenId = CompanyUserAuthRestApiConfig::RESOURCE_COMPANY_USER_ACCESS_TOKENS;

        return $resource;
    }
}
