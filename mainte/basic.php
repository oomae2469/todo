<?php
//ファイルのパスの表示
echo __FILE__;
//パスワードの作成
echo(password_hash('password123', PASSWORD_BCRYPT));