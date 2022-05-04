<?php
/**
 * Hooks
 *
 * @package tomjn.com
 */

namespace tomjn;

require_once 'http2.php';
require_once 'remove-emoji.php';

\tomjn\emoji\bootstrap();
\tomjn\http2\bootstrap();
