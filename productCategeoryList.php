<body id="CatAndSub" onload="renderCatAndSubOnLoad()">
<div class="listContainer">
    <h3 class='capsuleHeader'>Product Categories</h3>
    <ul class="aa1-linkList">
        <?php
        $selCatconnection = new connectDB();
        $selCatquery ="select * from category where cattype='product'";
        $selCatconnection->query($selCatquery);
        echo "<div id=\"parentCat\" class= \"parentCatList\" >";
        while($catrow = $selCatconnection->query_fetch())
        {
            $selSubCatquery ="SELECT `subcatid`, `subcatname`,`subcatdescription` FROM  `subcategory` WHERE subcattype = 'product' and catid = '".$catrow['catid']."'";
            $selSubCatconnection = new connectDB();
            $selSubCatconnection->query($selSubCatquery);
            echo "<div id=\"cat$catrow[catid]\" class= \"catList\" onclick=\"renderSubCat($catrow[catid])\">";
            echo "<li>";
            echo "  $catrow[catname]";
            echo "</li>";
            //$selectedSubCatParent is created at header.php
            if($selectedSubCatParent != $catrow['catid']){
                echo "<div id=\"subcat$catrow[catid]\" style=\"display:none;\">";
            }else{
                echo "<div id=\"subcat$catrow[catid]\" style=\"display:inline;\">";
            }
            while($subcatrow = $selSubCatconnection->query_fetch())
            {
                echo "<li>";
                echo "  <a href=\"./index.php?subcatid=".$subcatrow['subcatid']."\">".$subcatrow['subcatname']."</a>";
                echo "</li>";
            }
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        $selCatconnection->close();
        ?>
    </ul>
</div>
</body>
