<?php

namespace TidioLiveChat\Admin;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Admin\Notice\DismissibleNoticeService;
use TidioLiveChat\Admin\Notice\Exception\NoticeNameIsNotAllowedException;
use TidioLiveChat\Translation\ErrorTranslator;
use TidioLiveChat\Utils\QueryParameters;

class AdminNotice
{
    /**
     * @var ErrorTranslator
     */
    private $errorTranslator;

    /**
     * @var DismissibleNoticeService
     */
    private $dismissibleNoticeService;

    /**
     * @param ErrorTranslator $errorTranslator
     * @param DismissibleNoticeService $dismissibleNoticeService
     */
    public function __construct($errorTranslator, $dismissibleNoticeService)
    {
        $this->errorTranslator = $errorTranslator;
        $this->dismissibleNoticeService = $dismissibleNoticeService;

        add_action('admin_notices', [$this, 'addAdminErrorNotice']);
        add_action('admin_notices', [$this, 'addPhp72RequirementDismissibleNotice']);
    }

    public function addAdminErrorNotice()
    {
        if (!QueryParameters::has('error')) {
            return;
        }

        $errorCode = QueryParameters::get('error');
        $errorMessage = $this->errorTranslator->translate($errorCode);
        echo sprintf('<div class="notice notice-error is-dismissible"><p>%s</p></div>', $errorMessage);
    }

    public function addPhp72RequirementDismissibleNotice()
    {
        $script = $this->getNoticeFile(__DIR__ . '/Notice/Views/Php72RequirementNotice.php');

        try {
            $this->dismissibleNoticeService->displayNotice(
                $script,
                DismissibleNoticeService::PHP_7_2_REQUIREMENT_NOTICE
            );
        } catch (NoticeNameIsNotAllowedException $exception) {
            // do not display notice if notice name is invalid
        }
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function getNoticeFile($path)
    {
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
