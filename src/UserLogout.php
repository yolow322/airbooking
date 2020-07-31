<?php
/**
 *
 * For log out user from site
 *
 */
session_start();
session_unset();
session_destroy();
