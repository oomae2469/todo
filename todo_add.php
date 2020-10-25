<?php
require_once("functions.php");
$task = (string)filter_input(INPUT_POST, "task");

//**空で入力したときにエラーメッセージつきで返す */
if ($task === "") {
   redirect_with_message("todo_list.php", MESSAGE_TASK_EMPTY);
}

//**140文字以上入力した時にエラーメッセージつきで返す */
if (mb_strlen($task) >= 140) {
   redirect_with_message("todo_list.php", MESSAGE_TASK_EMPTY);
}

$lock_handle = lock_file();

//タスク入力時に必要な情報
$id = new_get_todo_id();
$date = date('Y-m-d H:m:s');
$status = STATUS_OPENED;
$todo = [$id, $task, $date, $status];

add_todo_list($todo);

unlock_file($handle);

redirect("todo_list.php");