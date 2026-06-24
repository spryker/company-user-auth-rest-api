<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyUserAuthRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyUserAuthRestApiConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @var string
     */
    public const RESOURCE_COMPANY_USER_ACCESS_TOKENS = 'company-user-access-tokens';

    /**
     * @api
     *
     * @var string
     */
    public const CONTROLLER_COMPANY_USER_ACCESS_TOKENS_RESOURCE = 'company-user-access-tokens-resource';

    /**
     * @api
     *
     * @var string
     */
    public const CLIENT_GRANT_USER = 'idCompanyUser';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_DETAIL_MISSING_ACCESS_TOKEN = 'Missing access token.';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_DETAIL_INVALID_ACCESS_TOKEN = 'Invalid access token.';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_DETAIL_INVALID_LOGIN = 'Failed to authenticate user.';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_CODE_ACCESS_CODE_INVALID = '001';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_CODE_FORBIDDEN = '002';

    /**
     * @api
     *
     * @var string
     */
    public const RESPONSE_CODE_INVALID_LOGIN = '003';
}
