<?php
  require 'lib/check.php';
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/myportfoliosite.js"></script>
    <title>my corporate site</title>
  </head>
  <body>
    <header class="site-header wrapper">
      <a href="index.html" class="top_link" ><img src="img/top_link.png"/></a>
    </header>
    <div class="top_image">
      <p>
        my portfolio site
      </p>
    </div>
    <div class="page_nav wrapper">
      <a href="aboutme.html" class="nav_items"/>about me</a>
      <a href="works.html" class="nav_items"/>works</a>
      <a href="contact.php" class="nav_items"/>contact</a>
    </div>
    <div class="top_main wrapper">
      <?php
        if ($result) {
          print "<div class=\"send_true\">\n";
          print "送信が完了しました。お問い合わせありがとうございます。\n";
          print "</div>\n";
        }
      ?>
      <form method="post">
        <div>
          <label for="name">お名前（必須）</label>
          <span class="error">
            <?php
              if (isset($error['name'])) {
                echo h( $error['name'] );
              }
            ?>
          </span>
          <input type="text" id="name" name="name"  maxlength="20" placeholder="お名前をご記入ください" value="<?php echo h($name); ?>"/>
        </div>
        <div>
          <label for="mail_address">メールアドレス（必須）</label>
          <span class="error">
            <?php
              if (isset($error['mail_address'])) {
                echo h( $error['mail_address'] );
              }
            ?>
          </span>
          <input type="email" id="mail_address" name="mail_address" maxlength="255" placeholder="メールアドレスをご記入ください" value="<?php echo h($mail_address); ?>"/>
        </div>
        <div>
          <label for="inquiry">お問い合わせ内容（必須）</label>
          <span class="error">
            <?php
              if (isset($error['inquiry'])) {
                echo h( $error['inquiry'] );
              }
            ?>
          </span>
          <textarea id="inquiry" name="inquiry" rows="8" cols="80" placeholder="お問い合わせ内容（500文字まで）をご記入ください" ><?php echo h($inquiry); ?></textarea>
        </div>
        <div>
          <button type="submit" id="send" name="submitted">送信</button>
        </div>
      </form>
    </div>
    <footer>©2021 sample.name All rights Rsereved</footer>
  </body>
</html>
