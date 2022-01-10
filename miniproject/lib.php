<?php

function sanitize($param) {
    return htmlspecialchars(strip_tags($param));
}