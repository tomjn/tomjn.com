<?php
/**
 * Hooks
 *
 * @package tomjn.com
 */

namespace tomjn;

require_once 'inc/http2.php';
require_once 'inc/remove-emoji.php';

\tomjn\emoji\bootstrap();
\tomjn\http2\bootstrap();
