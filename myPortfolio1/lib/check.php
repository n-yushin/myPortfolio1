<?php

// メール送信結果
$result = false;


// POSTデータが存在すればその値を、無ければnullで設定
$name = isset( $_POST['name']) ? $_POST['name'] : NULL;
$mail_address = isset( $_POST['mail_address']) ? $_POST['mail_address'] : NULL;
$inquiry = isset( $_POST['inquiry']) ? $_POST['inquiry'] : NULL;

// POSTされたデータの左右空白分をトリム
$name = trim($name);
$mail_address = trim($mail_address);
$inquiry = trim($inquiry);

// 送信ボタン押下時の処理
// if (isset($_POST['submitted'])) {
//   // POSTされたデータをcheckInput関数にてチェック
//   $_POST = checkInput($_POST);
//   // test用
//   // 送信ボタンが押下されたらいったん成功扱い
//   $result = true;
//   // test用
// }

// エラーメッセージ格納用配列
$error = array();
//$error['name'] = 'unchi';

// 送信ボタン押下字のチェック処理
if (isset($_POST['submitted'])) {
  // POSTされたデータの共通チェック
  $_POST = checkInput( $_POST );
  // お名前チェック
  if ($name == '') {
    $error['name'] = '*お名前は必須入力です';
  }
  else if ( preg_match( '/\A[[:^cntrl:]]{1,30}\z/u', $name ) == 0 ) {
      $error['name'] = '*お名前は30文字以内でお願いします。';
  }
  // メールアドレスチェック
  if ( $mail_address == '' ) {
    $error['mail_address'] = '*メールアドレスは必須です。';
  } else { //メールアドレスを正規表現でチェック
    $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
    if ( !preg_match( $pattern, $mail_address ) ) {
      $error['mail_address'] = '*メールアドレスの形式が正しくありません。';
    }
  }
  // お問い合わせ内容チェック
  if ( $inquiry == '' ) {
    $error['inquiry'] = '*内容は必須項目です。';
    //制御文字（タブ、復帰、改行を除く）でないことと文字数をチェック
  } else if ( preg_match( '/\A[\r\n\t[:^cntrl:]]{1,1050}\z/u', $inquiry ) == 0 ) {
    $error['inquiry'] = '*内容は500文字以内でお願いします。';
  }

  // どこかにエラーあれば失敗扱い
  if (!isset($error)) {
    $result = false;
  }
}

// 送信結果が成功であれば入力値初期化
if ($result) {
  $name = '';
  $mail_address = '';
  $inquiry = '';
}


// 入力値のエスケープ処理(PHPから出ていくところの処理)
function h ($var) {
  if(is_array($var)) {
      // $varが配列の場合、h関数をそれぞれの要素について再帰的に呼び出す
      return array_map('h', $var); // array_mapによるh関数コールバック
  }
  else {
    return htmlspecialchars($var, ENT_QUOTES,'UTF-8');
  }
}

// 入力値に不正なデータがないかチェック
function checkInput ($var) {
  // $varが配列の場合、checkInput関数をそれぞれの要素について再帰的に呼び出す
  if (is_array($var)) {
      array_map('checkInput', $var);
  }
  else {
      // NULLバイト攻撃対策
      if (preg_match('/\0/', $var)) {
        die('不正な入力です。');
      }
      // 文字エンコードチェック
      if (!mb_check_encoding( $var, 'UTF-8')) {
        die('不正な入力です。');
      }
      //改行、タブ以外の制御文字のチェック
      if(preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $var) === 0){
        die('不正な入力です。制御文字は使用できません。');
      }
  }
  return $var;
}

?>
