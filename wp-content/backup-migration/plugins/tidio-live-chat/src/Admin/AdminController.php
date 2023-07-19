<?php

namespace TidioLiveChat\Admin;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Admin\Notice\DismissibleNoticeService;
use TidioLiveChat\Sdk\Api\Exception\TidioApiException;
use TidioLiveChat\Sdk\IntegrationFacade;
use TidioLiveChat\IntegrationState;
use TidioLiveChat\TidioLiveChat;
use TidioLiveChat\Utils\QueryParameters;

class AdminController
{
    /**
     * @var IntegrationFacade
     */
    private $integrationFacade;
    /**
     * @var IntegrationState
     */
    private $integrationState;
    /**
     * @var NonceValidator
     */
    private $nonceValidator;
    /**
     * @var DismissibleNoticeService
     */
    private $dismissibleNoticeService;

    /**
     * @param IntegrationFacade $integrationFacade
     * @param IntegrationState $integrationState
     * @param NonceValidator $nonceValidator
     * @param DismissibleNoticeService $dismissibleNoticeService
     */
    public function __construct($integrationFacade, $integrationState, $nonceValidator, $dismissibleNoticeService)
    {
        $this->integrationFacade = $integrationFacade;
        $this->integrationState = $integrationState;
        $this->nonceValidator = $nonceValidator;
        $this->dismissibleNoticeService = $dismissibleNoticeService;
    }

    public function handleIntegrateProjectAction()
    {
        if (!$this->isRequestNonceValid(AdminRouting::INTEGRATE_PROJECT_ACTION)) {
            wp_die('', 403);
        }

        $refreshToken = QueryParameters::get('refreshToken');
        try {
            $data = $this->integrationFacade->integrateProject($refreshToken);
        } catch (TidioApiException $exception) {
            $errorCode = $exception->getMessage();
            $this->redirectToPluginAdminDashboardWithError($errorCode);
        }

        $this->integrationState->integrate(
            $data['projectPublicKey'],
            $data['accessToken'],
            $data['refreshToken']
        );

        $this->redirectToPluginAdminDashboard();
    }

    public function handleToggleAsyncLoadingAction()
    {
        if (!$this->isRequestNonceValid(AdminRouting::TOGGLE_ASYNC_LOADING_ACTION)) {
            wp_die('', 403);
        }

        $this->integrationState->toggleAsyncLoading();

        $this->redirectToPluginsListDashboard();
    }

    public function handleClearAccountDataAction()
    {
        if (!$this->isRequestNonceValid(AdminRouting::CLEAR_ACCOUNT_DATA_ACTION)) {
            wp_die('', 403);
        }

        $this->integrationState->removeIntegration();
        $this->dismissibleNoticeService->clearDismissedNoticesHistory();

        $this->redirectToPluginsListDashboard();
    }

    /**
     * @param string $nonce
     * @return bool
     */
    private function isRequestNonceValid($nonce)
    {
        return $this->nonceValidator->isRequestNonceValid($nonce);
    }

    private function redirectToPluginsListDashboard()
    {
        wp_redirect(admin_url('plugins.php'));
        die();
    }

    private function redirectToPluginAdminDashboard()
    {
        $url = 'admin.php?page=' . TidioLiveChat::TIDIO_PLUGIN_NAME;
        wp_redirect(admin_url($url));
        die();
    }

    /**
     * @param string $errorCode
     */
    private function redirectToPluginAdminDashboardWithError($errorCode)
    {
        $url = sprintf('admin.php?page=%s&error=%s', TidioLiveChat::TIDIO_PLUGIN_NAME, $errorCode);
        wp_redirect(admin_url($url));
        die();
    }
}
