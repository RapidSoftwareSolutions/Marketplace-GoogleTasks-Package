<?php
$routes = [
    'metadata',
    'getAccessToken',
    'refreshToken',
    'revokeAccessToken',
    'getAllTaskLists',
    'getTaskList',
    'createTaskList',
    'updateTaskList',
    'deleteTaskList',
    'patchTaskList',
    'getAllTasks',
    'getTask',
    'createTask',
    'updateTask',
    'deleteTask',
    'clearTaskList',
    'moveTask',
    'patchTask'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

