<?php 

    $title="Каталог товаров";

    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/modules/header.php');

    $allChoiceCategoryBlocks='';
    //d($_SERVER);
    $query_category="SELECT * FROM `categories` WHERE `parent_id`=1";
    
    $result_category=mysqli_query($link, $query_category);

    $allCategoryBlocks='';
    while($nav_row=mysqli_fetch_assoc($result_category)) {
        $allCategoryBlocks.="
            <div class='choice_section_list_item' data-content='{$nav_row['id']}'>
                {$nav_row['category']}
            </div>
        ";
    }

?>

    <div class="caption">
        <h1><?=$name_page; ?></h1>
        <p>Все товары</p>
    </div>

    <div class="choice wrapper">
        <div class="choice_section category" data-name="category">
            <div class="choice_section_name">
                <div class="choice_section_name_text">
                    Категория
                </div>
                <div class="choice_section_name_arrow arrow-down">

                </div>
            </div>
            <div class="choice_section_list">
                <?=$allCategoryBlocks; ?>
                <!-- <div class="choice_section_list_item" data-content="4">
                    Куртки
                </div>
                <div class="choice_section_list_item" data-content="5">
                    Обувь
                </div>
                <div class="choice_section_list_item" data-content="6">
                    Брюки
                </div> -->
            </div>
        </div>
        
        <div class="choice_section size" data-name="size">
            <div class="choice_section_name">
                <div class="choice_section_name_text">
                    Размер
                </div>
                <div class="choice_section_name_arrow arrow-down">

                </div>
            </div>
            <div class="choice_section_list">
                <div class="choice_section_list_item" data-content="L">
                    L
                </div>
                <div class="choice_section_list_item" data-content="XL">
                    XL
                </div>
                <div class="choice_section_list_item" data-content="XXL">
                    XXL
                </div>
                <div class="choice_section_list_item" data-content="XXXL">
                    XXXL
                </div>
            </div>
        </div>
        
        <div class="choice_section cost" data-name="price">
            <div class="choice_section_name">
                <div class="choice_section_name_text">
                    Стоимость
                </div>
                <div class="choice_section_name_arrow arrow-down">

                </div>
            </div>
            <div class="choice_section_list">
                <div class="choice_section_list_item" data-content="0-1000">
                    0-1000 руб.
                </div>
                <div class="choice_section_list_item" data-content="1000-3000">
                    1000-3000 руб.
                </div>
                <div class="choice_section_list_item" data-content="3000-6000">
                    3000-6000 руб.
                </div>
                <div class="choice_section_list_item" data-content="6000-20000">
                    6000-20000 руб.
                </div>
                <div class="choice_section_list_item" data-content="20000">
                    от 20000 руб.
                </div>
            </div>
        </div> 
    </div>

    <div class="catalog wrapper"></div>

    <div class="pagination wrapper"></div>

<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>

    <script src="/javascript/main.js"></script>
</body>
</html>