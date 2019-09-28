<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

    // sleep(3);
    $conditions_category='';
    if(!empty($_GET['category']) && isset($_GET['category'])) {
        $category=$_GET['category'];
        $conditions_category="`category`={$category}";
    }

    $conditions_price='';
    if(!empty($_GET['price']) && isset($_GET['price'])) {
        $price=$_GET['price'];

        $price_array=explode('-', $price);

        if(count($price_array)==2) {
            $conditions_price="`price` BETWEEN {$price_array[0]} AND {$price_array[1]}";
        } else {
            $conditions_price="`price` >= {$price_array[0]}";
        }
    }

    $count_products_on_page=4;

    if(!empty($_GET['numPage'])) {
        $now_page=$_GET['numPage'];
    }

    $start_row=($now_page-1)*$count_products_on_page;

    if ( (empty($_GET['category']) || !isset($_GET['category'])) && (empty($_GET['price']) || !isset($_GET['price'])) ) {
        $count_sql="SELECT * FROM `catalog`";
        
        $query = "SELECT * FROM `catalog` limit {$start_row}, {$count_products_on_page}";
        
    } elseif ( (!empty($_GET['category']) && isset($_GET['category'])) && (empty($_GET['price']) || !isset($_GET['price'])) ) {
        $count_sql="SELECT * FROM `catalog` WHERE {$conditions_category}";

        $query = "SELECT * FROM `catalog` WHERE {$conditions_category} limit {$start_row}, {$count_products_on_page}";
        
    } elseif( (empty($_GET['category']) || !isset($_GET['category'])) && (!empty($_GET['price']) && isset($_GET['price'])) ) {
        $count_sql="SELECT * FROM `catalog` WHERE {$conditions_price}";

        $query = "SELECT * FROM `catalog` WHERE {$conditions_price} limit {$start_row}, {$count_products_on_page}";
        
    } elseif( (!empty($_GET['category']) && isset($_GET['category'])) && (!empty($_GET['price']) && isset($_GET['price'])) ) {
        $count_sql="SELECT * FROM `catalog` WHERE {$conditions_category} AND {$conditions_price}";

        $query = "SELECT * FROM `catalog` WHERE {$conditions_category} AND {$conditions_price} limit {$start_row}, {$count_products_on_page}";
        
    }

    $result_count = mysqli_query($link, $count_sql);
    $count_pages=ceil(mysqli_num_rows($result_count)/$count_products_on_page);

    $result = mysqli_query($link, $query);

    $data=[
        'products'=> [],
        'pagination'=> [
            'countPages'=> $count_pages,
            'nowPage'=> $now_page
        ],
        'categories'=> []
    ];

    while( $row = mysqli_fetch_assoc($result) ) {
        array_push($data['products'], $row);
    }

    $cat=$_GET['cat'];
    
    $query_categories="SELECT * FROM `categories` WHERE `parent_id`=$cat";
    $result_categories=mysqli_query($link, $query_categories);
    while($cat_row=mysqli_fetch_assoc($result_categories)) {
        array_push($data['categories'], $cat_row['category']);
    }
    

    echo json_encode($data);
?>