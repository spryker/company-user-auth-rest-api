<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyUserAuthRestApi;

use Spryker\Glue\CompanyUserAuthRestApi\Dependency\Client\CompanyUserAuthRestApiToCompanyUserStorageClientBridge;
use Spryker\Glue\CompanyUserAuthRestApi\Dependency\Client\CompanyUserAuthRestApiToOauthClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Spryker\Glue\CompanyUserAuthRestApi\CompanyUserAuthRestApiConfig getConfig()
 */
class CompanyUserAuthRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_OAUTH = 'CLIENT_OAUTH';

    /**
     * @var string
     */
    public const CLIENT_COMPANY_USER_STORAGE = 'CLIENT_COMPANY_USER_STORAGE';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addOauthClient($container);
        $container = $this->addCompanyUserStorageClient($container);

        return $container;
    }

    protected function addOauthClient(Container $container): Container
    {
        $container->set(static::CLIENT_OAUTH, function (Container $container) {
            return new CompanyUserAuthRestApiToOauthClientBridge($container->getLocator()->oauth()->client());
        });

        return $container;
    }

    protected function addCompanyUserStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_COMPANY_USER_STORAGE, function (Container $container) {
            return new CompanyUserAuthRestApiToCompanyUserStorageClientBridge($container->getLocator()->companyUserStorage()->client());
        });

        return $container;
    }
}
