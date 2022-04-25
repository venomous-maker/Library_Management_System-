<?php
session_start();
require_once( '../connect.php' );
if ( isset( $_SESSION[ 'adminID' ] ) == '' ) {
    if ( isset( $_SESSION[ 'user_id' ] ) == '' ) {
        echo 'encoutered log in error TRY_AGAIN';
        header( 'Location: ../login.php' );
    }
}
header("refresh: 300 ../logout.php");
?>
<!DOCTYPE html>
<html lang = 'en' dir = 'ltr'>

<head>
<title>ALL BOOKS DETAILS | LIBRARY MANAGEMENT SYSTEM</title>
<meta charset = 'UTF-8'>
<!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
<link rel = 'stylesheet' href = '../style.css'>
<!-- Boxicons CDN Link -->
<link href = 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel = 'stylesheet'>
<link rel = 'stylesheet' type = 'text/css' href = '../index.css' media = 'screen' />
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
</head>

<body>
<nav>
<div class = 'navbar'>
<i class = 'bx bx-menu'></i>
<div>
<img src = "<?php echo '../dashboard/upload/'.$_SESSION['realimage']  ?>" alt = 'Avatar' class = 'avatar'>
</div>
<div class = 'logo'><a href = '#'><?php echo $_SESSION[ 'First_name' ]  ?> <?php echo $_SESSION[ 'Sir_name' ]  ?></a></div>
<div class = 'nav-links'>
<div class = 'sidebar-logo'>
<span class = 'logo-name'>Menu</span>
<i class = 'bx bx-x'></i>
</div>
<ul class = 'links'>
<?php if ( isset( $_SESSION[ 'adminID' ] ) ) echo "<li><a href = '../admin'>HOME</a></li>"?>
<?php if ( isset( $_SESSION[ 'user_id' ] ) ) echo "<li><a href = '../dashboard'>HOME</a></li>"?>
<?php if ( isset( $_SESSION[ 'adminID' ] ) ) echo "
<li>
<a href = '#'>USERS PANEL</a>
<i class = 'bx bxs-chevron-down htmlcss-arrow arrow  '></i>
<ul class = 'htmlCss-sub-menu sub-menu'>
<li><a href = '../admin/mem_details.php'>All Member Details</a></li>
<li><a href = '../Admin/_adminreg.php'>Promote Member</a></li>
<li><a href = '#'>Card Design</a></li>
<li class = 'more'>
<span><a href = '#'>More</a>
<i class = 'bx bxs-chevron-right arrow more-arrow'></i>
</span>
<ul class = 'more-sub-menu sub-menu'>
<li><a href = '#'>Neumorphism</a></li>
<li><a href = '#'>Pre-loader</a></li>
<li><a href = '#'>Glassmorphism</a></li>
</ul>
</li>
</ul>
</li>";
?>
<li>
<a href = '#'>LIBRARY PANEL</a>
<i class = 'bx bxs-chevron-down htmlcss-arrow arrow  '></i>
<ul class = 'htmlCss-sub-menu sub-menu'>
<?php if ( isset( $_SESSION[ 'adminID' ] ) ) echo "<li><a href = './'>Add Book Stock</a></li>";
?>
<li><a href = './exist_books.php'>View Existing Books</a></li>
<li><a href = '../dashboard/issue.php'>Borrow Book</a></li>
<li><a href = '../books/my_borrowed_books.php'>My Borrowed Books</a></li>
<li class = 'more'>
<span><a href = '#'>More</a>
<i class = 'bx bxs-chevron-right arrow more-arrow'></i>
</span>
<ul class = 'more-sub-menu sub-menu'>
<li><a href = '#'>Neumorphism</a></li>
<li><a href = '#'>Pre-loader</a></li>
<li><a href = '#'>Glassmorphism</a></li>
</ul>
</li>
</ul>
</li>
<li>
<a href = '#'>USER DETAILS</a>

<i class = 'bx bxs-chevron-down js-arrow arrow '></i>
<ul class = 'js-sub-menu sub-menu'>
<?php if ( isset( $_SESSION[ 'adminID' ] ) ) echo "<li><a href = '../admin/_admin_details.php'>Registration Details</a></li>";
?>
<?php if ( isset( $_SESSION[ 'user_id' ] ) ) echo "<li><a href = '../dashboard/reg_details.php'>Registration Details</a></li>";
?>
<li><a href = '#'>Form Validation</a></li>
<li><a href = '#'>Card Slider</a></li>
<li><a href = '#'>Complete Website</a></li>
</ul>
</li>
<li><a href = '#'>ABOUT US</a></li>
<li><a href = '#'>CONTACT US</a></li>
<li>
<a href = '#'>ACCOUNT</a>
<i class = 'bx bxs-chevron-down Zs-arrow arrow '></i>
<ul class = 'zs-sub-menu sub-menu'>
<li><a href = '../logout.php'>Log Out</a></li>
</ul>
</li>
</ul>
</div>
<div class = 'search-box'>
<i class = 'bx bx-search'></i>
<div class = 'input-box'>
<form action = '../admin/search.php'method = 'post'>
<input type = 'text' name = 'text'placeholder = 'Search...<?php if ( isset( $_SESSION[ 'search' ] ) ) echo $_SESSION[ 'search' ]?>'>
</form>
</div>
</div>

</div>
<div class = 'venom'>
<?php
$query = 'SELECT * FROM books1';

if ( $result = $conn->query( $query ) ) {
    echo "
                <div class ='tab' style='overflow: auto; width: 90%; height:90%;'>
                <table border='1'>
                
                <tr>
                
                <th>Number</th>
                <th>ISBN</th>
                <th>Book Title</th>
                <th>Book Type</th>
                <th>Author Name</th>
                <th>Quantity</th>
                <th>Purchase Date</th>
                <th>Edition</th>
                <th>Price</th>
                <th>Pages</th>
                <th>Publisher</th>
                
                </tr>";
    $num = 1;
    while ( $row = $result->fetch_assoc() ) {
        echo '<tr>';
        echo'<td>'.$num.'</td>';
        echo '<td>'.$row[ 'ISBN' ].'</td>';
        echo'<td>'.$row[ 'Book_Title' ].'</td>';
        echo'<td>'.$row[ 'Book_Type' ].'</td>';
        echo '<td>'.$row[ 'Author_Name' ].'</td>';
        echo '<td>'.$row[ 'Quantity' ].'</td>';
        echo'<td>'.$row[ 'Purchase_Date' ].'</td>';
        echo '<td>'.$row[ 'Edition' ].'</td>';
        echo '<td>'.$row[ 'Price' ].'</td>';
        echo'<td>'.$row[ 'Pages' ].'</td>';
        echo'<td>'.$row[ 'Publisher' ].'</td>';
        echo '</tr>';
        $num += 1;

    }
    echo '</table> </div>';
}

?>
</div>
</div>
</div>
</nav>
</nav>

<script src = '../index.js'></script>
</body>

</html>