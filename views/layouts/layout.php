<?php

require_once __DIR__ . '/header.php';

if (isset($contentView)) {
    require_once $contentView;
}

require_once __DIR__ . '/footer.php';