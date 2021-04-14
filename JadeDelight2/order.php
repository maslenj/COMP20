<html>
<body>
    <?php
        $fName = $_GET["fname"];
        if ($fName !== "") {
            echo "First name: " . $fName . "<br>";
        } 
        
        $lName = $_GET["lname"];
        echo "Last name: " . $lName . "<br>";
        
        $street = $_GET["street"];
        if ($street !== "") {
            echo "Street: " . $street . "<br>";
        }

        $city = $_GET["city"];
        if ($city !== "") {
            echo "City: " . $city . "<br>";
        }

        $phone = $_GET["phone"];
        if ($phone !== "") {
            echo "Phone: " . $phone . "<br>";
        }

        echo "<br> Your Order Is: <br>";
        if ($_GET["quan1"] > 0) { 
            echo $_GET["quan1"] . "xChicken Chop Suey<br>";  
        }
        if ($_GET["quan2"] > 0) { 
            echo $_GET["quan2"] . "xSweet and Sour Pork<br>";  
        }
        if ($_GET["quan3"] > 0) { 
            echo $_GET["quan3"] . "xShrimp Lo Mein<br>";  
        }
        if ($_GET["quan4"] > 0) { 
            echo $_GET["quan4"] . "xMoo Shi Chicken<br>";  
        }
        if ($_GET["quan5"] > 0) { 
            echo $_GET["quan5"] . "xFried Rice<br>";  
        }

        echo "<br>";
        echo "Subtotal:" . $_GET['subtotal'] . "<br>";
        echo "Tax:" . $_GET['tax'] . "<br>";
        echo "Total:" . $_GET['total'] . "<br>";
        echo '<p>' . $_GET['pickupMessage'] . '</p>';
    ?>
</body>
</html>