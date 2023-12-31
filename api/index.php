<?php

declare(strict_types=1);

define("SUCCESS", 200);
define("VALIDATION_ERROR", 422);
define("INVALID_METHOD", 405);

header('Content-type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(INVALID_METHOD);
    echo json_encode([
        'status_code' => INVALID_METHOD,
        'message' => 'Invalid method. Only "GET" method is allowed'
    ]);
    exit();
}

if (!isset($_GET['slack_name'])) {
    http_response_code(VALIDATION_ERROR);
    echo json_encode([
        'status_code' => VALIDATION_ERROR,
        'message' => 'slack_name is required'
    ]);
    exit();
}

$slack_name = strval(trim(htmlentities($_GET['slack_name'])));
if (empty($slack_name)) {
    http_response_code(VALIDATION_ERROR);
    echo json_encode([
        'status_code' => VALIDATION_ERROR,
        'message' => 'slack_name cannot be empty'
    ]);
    exit();
}

if (!isset($_GET['track'])) {
    http_response_code(VALIDATION_ERROR);
    echo json_encode([
        'status_code' => VALIDATION_ERROR,
        'message' => 'track is required'
    ]);
    exit();
}

$track = strval(trim(htmlentities($_GET['track'])));
if (empty($track)) {
    http_response_code(VALIDATION_ERROR);
    echo json_encode([
        'status_code' => VALIDATION_ERROR,
        'message' => 'track cannot be empty'
    ]);
    exit();
}

http_response_code(SUCCESS);
echo json_encode([
    "slack_name" => $slack_name,
    "current_day" => date('l', time()),
    "utc_time" => date("Y-m-d\TH:i:s\Z", time()),
    "track" => $track,
    "github_file_url" => "https://github.com/codelikesuraj/hngx-task1/blob/main/api/index.php",
    "github_repo_url" => "https://github.com/codelikesuraj/hngx-task1",
    "status_code" => SUCCESS
]);
