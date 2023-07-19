<?php

namespace TidioLiveChat\Admin;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Admin\Notice\DismissibleNoticeController;

class AdminRouting
{
    const CLEAR_ACCOUNT_DATA_ACTION = 'tidio-live-chat-clear-account-data';
    const INTEGRATE_PROJECT_ACTION = 'tidio-live-chat-integrate-project';
    const TOGGLE_ASYNC_LOADING_ACTION = 'tidio-live-chat-toggle-async-loading';
    const DISMISS_NOTICE_ACTION = 'tidio-live-chat-dismiss-notice';

    /**
     * @param AdminController $adminController
     * @param DismissibleNoticeController $dismissibleNoticeController
     */
    public function __construct($adminController, $dismissibleNoticeController)
    {
        add_action('admin_post_' . self::INTEGRATE_PROJECT_ACTION, [$adminController, 'handleIntegrateProjectAction']);
        add_action('admin_post_' . self::TOGGLE_ASYNC_LOADING_ACTION, [$adminController, 'handleToggleAsyncLoadingAction']);
        add_action('admin_post_' . self::CLEAR_ACCOUNT_DATA_ACTION, [$adminController, 'handleClearAccountDataAction']);
        add_action('admin_post_' . self::DISMISS_NOTICE_ACTION, [$dismissibleNoticeController, 'handleDismissNotice']);
    }

    /**
     * @return string
     */
    public static function getEndpointForIntegrateProjectAction()
    {
        return self::getEndpointForAction(self::INTEGRATE_PROJECT_ACTION);
    }

    /**
     * @return string
     */
    public static function getEndpointForToggleAsyncLoadingAction()
    {
        return self::getEndpointForAction(self::TOGGLE_ASYNC_LOADING_ACTION);
    }

    /**
     * @return string
     */
    public static function getEndpointForClearAccountDataAction()
    {
        return self::getEndpointForAction(self::CLEAR_ACCOUNT_DATA_ACTION);
    }

    /**
     * @param string $noticeOptionName
     * @return string
     */
    public static function getEndpointForHandleDismissNotice($noticeOptionName)
    {
        return self::getEndpointForAction(
            self::DISMISS_NOTICE_ACTION,
            [DismissibleNoticeController::TIDIO_NOTICE_QUERY_PARAM_NAME => $noticeOptionName]
        );
    }

    /**
     * @param string $action
     * @return string
     */
    private static function getEndpointForAction($action, array $params = [])
    {
        $params['action'] = $action;
        $params['_wpnonce'] = wp_create_nonce($action);

        $queryString = http_build_query($params);

        return admin_url('admin-post.php?' . $queryString);
    }
}
