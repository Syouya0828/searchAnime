
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="anime.css">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="https://github.com/Syouya0828"><img src="img/github.png" alt=""></a>
    </header>
    <div id="main">
        <img src="img/logo.png" alt="" class="logo">
        <h1>年とシーズン選んでね</h1>
        <form id="post-form" method='post' action="anime.php">
            <select name="years" id="years-select">
            <?php
                $thisYear = date('Y');
                echo($thisYear);
                for ($i=2014; $i <= $thisYear; $i++) { 
                    echo('<option value="'.$i.'">'.$i.'年</option>');
                }
            ?>
            </select>
            <select name="season" id="season-select">
                <option value="1">冬アニメ</option>
                <option value="2">春アニメ</option>
                <option value="3">夏アニメ</option>
                <option value="4">秋アニメ</option>
            </select><br>
            <button>検索<span><img src="img/search.svg" alt="" class="search"></span></button>
        </form>
    </div>

    <div id="anime_contents">
    <?php
    if($_POST){
        $year = $_POST["years"];
        $season = $_POST["season"];
        $seasonName;
        //データ
        $url = "http://api.moemoe.tokyo/anime/v1/master/".$year."/".$season;
        $contents = file_get_contents($url);
        $json = mb_convert_encoding($contents, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $array = json_decode($json, true);
        
        switch ($season) {
            case '1':
                $seasonName = '冬アニメ';
                break;
            case '2':
                $seasonName = '春アニメ';
                break;
            case '3':
                $seasonName = '夏アニメ';
                break;
            case '4':
                $seasonName = '秋アニメ';
                break;
        }

        echo('<h2 class="searchResult">'.$year.'年の'.$seasonName.'です</h2>');
        for ($i=0; $i <= count($array)-1; $i++) { 
            echo(
                '<div class="anime">
                    <div class="title">'.$array[$i]["title"].'</div><br>
                    <div class="links">
                        <a href="'.$array[$i]["public_url"].'" class="website"><img src="img/website.svg" alt=""></a>
                        <a href="https://twitter.com/'.$array[$i]["twitter_account"].'" class="twitter"><img src="img/twitter.svg" alt=""></a>
                    </div>
                </div>'
            );
        }

    }
    ?>
    

    </div>
    
</body>

</html>