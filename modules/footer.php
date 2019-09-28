<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');


$query_footer_collection="SELECT * FROM `nav` WHERE active=1 ORDER BY priority";
$result_footer_collection=mysqli_query($link, $query_footer_collection);
$count_footer_collection=mysqli_num_rows($result_footer_collection);

$allCollectionsBlocks='';
for($i=0; $i<$count_footer_collection; $i++) {
    $footer_collection_row=mysqli_fetch_assoc($result_footer_collection);
    // $allCollectionsBlocks.="
    //     <a href='{$footer_collection_row['href']}'>{$footer_collection_row['name']} (<span class='quantity'></span>)</a>
    // ";

    if($i==0) {
        $allCollectionsBlocks.="
            <a href='{$footer_collection_row['href']}' class='footer-item_current'>{$footer_collection_row['name']} (<span class='quantity'></span>)</a>
        ";
    } else {
        $allCollectionsBlocks.="
            <a href='{$footer_collection_row['href']}'>{$footer_collection_row['name']} (<span class='quantity'></span>)</a>
        ";
    }
}
?>
    <footer class="wrapper">
        <div class="footer-item collections">
            <h3>КОЛЛЕКЦИИ</h3>

            <?=$allCollectionsBlocks; ?>

            <!-- <a href="/" class="collections-item">Женщинам (<span class="quantity">1725</span>)</a>
            <a href="/" class="collections-item footer-item_current">Мужчинам (<span class="quantity">635</span>)</a>
            <a href="/" class="collections-item">Детям (<span class="quantity">2514</span>)</a>
            <a href="/" class="collections-item">Новинки (<span class="quantity">76</span>)</a> -->

        </div>

        <div class="footer-item shop">
            <h3>МАГАЗИН</h3>
            <a href="/" class="shop-item">О нас</a>
            <a href="/" class="shop-item">Доставка</a>
            <a href="/" class="shop-item">Работа с нами</a>
            <a href="/" class="shop-item">Контакты</a>
        </div>

        <div class="footer-item socialWebs">
            <h3>МЫ В СОЦИАЛЬНЫХ СЕТЯХ</h3>
            <p>Сайт разработан в inordic.ru</p>
            <p>2018 &copy; Все права защищены</p>
            <div class="socialWebs_list">
                <a href="https://twitter.com/" class="socialWeb twitter"></a>
                <a href="https://www.facebook.com/" class="socialWeb facebook"></a>
                <a href="https://www.instagram.com/" class="socialWeb instagram"></a>
            </div>
        </div>
    </footer>

