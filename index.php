<?php
//LOVEDATAを lovedata.txt と定義する
define('LOVEDATA','./lovedata.txt');

//入力された文字列（名前）をlovedata.txtに出力する形式を定義
if($file_name = fopen(LOVEDATA,"r")){
  while ($view_data = fgets($file_name)) {
      $view_split_data = preg_split( '/\'/', $view_data);
      $view_split_data['your_name'] = $view_split_data[1];
      $view_split_data['another_name'] = $view_split_data[3];
  }
}

$name = null;
$split_data = array();


//↓「診断する」ボタンを押した時の動作
if (isset($_POST['submit'])) {

//悪い人がスクリプトを入力した時、システムが壊されないようにする対策
  $your_name = htmlspecialchars( $_POST['your_name'], ENT_QUOTES, 'UTF-8');
  $your_name = preg_replace( '/\\r\\n|\\n|\\r/', '', $your_name);
  $another_name = htmlspecialchars( $_POST['another_name'], ENT_QUOTES, 'UTF-8');
  $another_name = preg_replace( '/\\r\\n|\\n|\\r/', '<br>', $another_name);

  $name1 = $your_name;
  $name2 = $another_name;

  //入力された名前の文字列を一桁の数字に変換
  $name1 = urlencode($name1);
  $name2 = urlencode($name2);
  $name1 = preg_replace( "/[^0-9]/", "", $name1);
  $name2 = preg_replace( "/[^0-9]/", "", $name2);
  $name = $name1 + $name2;
  $keta = strlen($name);
  $name = $name / $keta;
  $name = substr( $name, 2, 1);

  //変換された一桁の数字に応じて結果を定義する
  if($name == 1){
  $name = '<h1>相性：<span id="percent">74%</h1><br><p id="result">ラブラブな関係が長続きするけど、そのせいで些細なことで喧嘩してしまうかも。</p>';
  }elseif ($name == 2){
  $name = '<h1>相性：<span id="percent">66%</h1><br><p id="result">話すテンポがよく合う。でもあまりに赤裸々に話すのは気をつけて。</p>';
  }elseif ($name == 3){
  $name = '<h1>相性：<span id="percent">97%</h1><br><p id="result">非の打ちどころ無し。意思疎通が完全に測れるタイプ。</p>';
  }elseif ($name == 4){
  $name = '<h1>相性：<span id="percent">56%</h1><br><p id="result">距離感をうまく保てるタイプだけどマンネリ化しがち。</p>';
  }elseif ($name == 5){
  $name = '<h1>相性：<span id="percent">43%</h1><br><p id="result">お互い趣味の違いから話が噛み合わないことあるかも。お互いが気を遣って話すことが大切</p>';
  }elseif ($name == 6){
  $name = '<h1>相性：<span id="percent">63%</h1><br><p id="result">付き合う前より付き合った後の方が燃えてくる。勇気を持って告白してみよう！</p>';
  }elseif ($name == 7){
  $name = '<h1>相性：<span id="percent">95%</h1><br><p id="result">お互いに気を遣い合うから喧嘩は少なそう。でも過剰な気遣いに疲れてしまうかも。</p>';
  }elseif ($name == 8){
  $name = '<h1>相性：<span id="percent">81%</h1><br><p id="result">愛情表現はしないタイプだけど以心伝心。形にこだわらないのがコツ。</p>';
  }elseif ($name == 9){
  $name = '<h1>相性：<span id="percent">53%</h1><br><p id="result">気遣いを忘れたら喧嘩の毎日。相手を大切にしてあげよう。</p>';
  }elseif ($name == 0){
  $name = '<h1>相性：<span id="percent">77%</h1><br><p id="result">お互いを思うあまり喧嘩になることも。お互い一歩引くことが大事。</p>';
}

    $file_name = fopen(LOVEDATA,"a");
    $date = date("Y-m-d H:i:s");
    $data = "'".$your_name."','".$another_name."'\n";
    //実際にlovedata.txtに出力
    fwrite($file_name,$data);
    //ファイルを閉じる
    fclose($file_name);

}
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="reset.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
    <title></title>
  </head>
  <body>
    <div class="container">
    <h1 class="title">相性適正診断</h1>

      <!-- 名前を入力するフォーム -->
      <form id="form" action="index.php" method="POST">
        <p>あなたの名前</p>
        <input id="name" type="text" name="your_name" value=""><br>
        <p>お相手の名前</p>
        <input id="name" type="text" name="another_name" value=""><br>
        <br><button id="submit" type="submit" name="submit">結果を見る</button>
      </form>


      <!-- 定義された結果をhtmlで出力する -->
      <div class="result"><?php echo $name; ?></div>


    </div>
  </body>
</html>
