<?php 

    include_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');

    if(isset($_SESSION['user_id'])) {
        $userData=getUserData($link, $_SESSION['user_id']);
    }

    $query_nav="SELECT * FROM `nav` WHERE active=1 ORDER BY priority";
    $result_nav=mysqli_query($link, $query_nav);
    $count_nav=mysqli_num_rows($result_nav);

    $name_page='';
    $allNavBlocks='';
    for($i=0; $i<$count_nav; $i++) {
        $nav_row=mysqli_fetch_assoc($result_nav);
        // $allNavBlocks.="
        //     <a href='{$nav_row['href']}' id='{$nav_row['id-tag']}' class='{$nav_row['class']}'>{$nav_row['name']}</a>
        // ";

        if($i==0) {
            $allNavBlocks.="
                <a href='{$nav_row['href']}' id='{$nav_row['id-tag']}' class='{$nav_row['class']} nav-link_current'>{$nav_row['name']}</a>
            ";
            $name_page=$nav_row['name'];
        } else {
            $allNavBlocks.="
                <a href='{$nav_row['href']}' id='{$nav_row['id-tag']}' class='{$nav_row['class']}'>{$nav_row['name']}</a>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <header class="wrapper">
        <div class="menu-links">
            <a href="/catalog/catalog.php" class="logo"></a>
            <nav>
                <?=$allNavBlocks; ?>
                <!-- <a href="/" class="nav-link-women">Женщинам</a>
                <a href="/" class="nav-link-men nav-link_current">Мужчинам</a>
                <a href="/" class="nav-link-children">Детям</a>
                <a href="/" class="nav-link-novelties">Новинки</a>
                <a href="/" class="nav-link-about-us">О нас</a> -->
            </nav>
        </div>
        <div class="purchase">
            <div class="customer">
                <div class="customer_pic"></div>
                <div class="customer_name">
                    
                    <?php if(isset($_SESSION['user_id'])): ; ?>
                    Привет, <?=$userData['name']; ?>! 
                    (<a href="/login/account.php" class="login">личный кабинет</a>)
                    <?php else: ; ?>
                    (<a href="/login/login.php" class="login">войти</a>)
                    <?php endif; ?>
                </div>
            </div>
            <div class="basket">
                <div class="basket_pic"></div>
                <div class="basket_data">
                    Корзина (<span class="quantity-in-basket"></span>)
                </div>
            </div>
        </div>
    </header>

    <div class="header-underline wrapper">
        <hr>
    </div>

    <div class="sandbox wrapper">
        <a href="/">ГЛАВНАЯ</a> / <span class="sandbox_page"><?=$name_page; ?></span>
    </div>