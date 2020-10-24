<?php
//基本情報の定義
define("STATUS_OPENED", "0");
define("STATUS_CLOSED", "1");
define("TODO_LIST_CSV", "date/todo_list.csv");
define("TODO_LIST_CSV_LOCK", "date/todo_list.csv.lock");

define("TASK_MAX_LENGTH", 140);
define("MESSAGE_LIST_EMPTY", "タスクが未入力です");
define("MESSAGE_TASK_MAX_LENGTH", "タスクが140文字を超えています");
define("MESSAGE_ID_INVALID", "入力されたIDは不正です");

/** 入力されたタスクの読み込み */
function read_todo_list($include_closed = true) {
    $handle = fopen(TODO_LIST_CSV, "r");
    $todo_list = [];
    while($todo = fgetcsv($handle)){
        if (!$inclued_closed && $todo[3] === STATUS_CLOSED) {
            continue;
        }
        $todo_list[] = $todo;
    }
    fclose($handle);
    return $todo_list;
}

//新しいIDの取得
function get_new_todo_id() {
  return count(read_todo_list()) + 1;
}

//新しいタスクを追加する
function add_todo_list($todo) {
    $handle = fopen(TODO_LIST_CSV, "a");
    fputcsv($handle, $todo);
    fclose($handle);
}

//タスク完了処理
function write_todo_list($todo_list) {
    $handle = fopen(TODO_LIST_CSV, "w");
    foreach ($todo_list as $todo) {
        fputcsv($handle, $todo);
    }
    fclose($handle);
}

function redirect_with_message($page, $message) {
    if(empty($message)) {
        redirect($message);
    }
    $message = urlencode($message);
    header("Location: " . $page
                        . "?message=${message}");
    exit();
}

/**初回アクセス時にメッセージがない場合からの文字列を返す */
function get_message() {
  $message = (string)filter_input(INPUT_GET, "message");
  if ($message === MESSAGE_TASK_EMPTY
      || $message === MESSAGE_TASK_MAX_LENGTH
      || $message === MESSAGE_ID_INVALID) {
    return $message;
  }
  return "";
}

/** lock_file関数の引数に LOCK_SHを指定してファイル共有ロックを取得する */
function lock_file($operation = LOCK_EX) {
  $handle = fopen(TODO_LIST_CSV_LOCK, "a");
  flock($handle, $operation);
  return $handle;
}

/** unlock_file関数によってファイルのロックを開放する */
function unlock_file($handle){
  flock($handle, LOCK_UN);
  fclose($handle);
}