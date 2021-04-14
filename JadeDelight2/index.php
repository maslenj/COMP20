<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Jade Delight</title>
</head>

<body>

    <script language="javascript">
        /* My code */
        let item_counts = [0, 0, 0, 0, 0]

        function validate() {
            let d = new Date()
			let h = d.getHours()
			let m = d.getMinutes()
            let pickUpMessage = ""
			if ($('input[value=delivery]:checked').val() == 'delivery') {
				m += 30
				if (m > 60) {
					m %= 60
					h++
				}
				pickUpMessage += "Your order will be delivered at " + h + ":" + m + '\n'
			} else {
				m += 15
				if (m > 60) {
					m %= 60
					h++
				}
				pickUpMessage += "Your order can be picked up at " + h + ":" + m + '\n'
			}
            $("input[name=pickupMessage]").val(pickUpMessage)
            let last_name = $("input[name=lname]").val()
            let phone_num = $("input[name=phone]").val()
            if (last_name == "") {
                alert("please enter a valid last name")
            } else {
                if (!phone_num.match(/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/)) {
                    alert("please enter a valid phone number")
                } else {
                    return true
                }
            }
            return false
        }

        function MenuItem(name, cost) {
            this.name = name;
            this.cost = cost;
        }

        menuItems = new Array(
            new MenuItem("Chicken Chop Suey", 4.5),
            new MenuItem("Sweet and Sour Pork", 6.25),
            new MenuItem("Shrimp Lo Mein", 5.25),
            new MenuItem("Moo Shi Chicken", 6.5),
            new MenuItem("Fried Rice", 2.35)
        );

        $(document).ready(() => {
            document.forms[0].onsubmit = validate;

            $('form p:nth-child(3)').css({
                'display': 'none'
            })
            $('form p:nth-child(4)').css({
                'display': 'none'
            })
            $('select').on('change', function() {
                let count = $(this).find(":selected").val()
                let item_num = parseInt(this.name.substring(4, 5))
                item_counts[item_num] = count
                let cost = count * menuItems[item_num].cost
                // get item_num + 1 row of table
                let query = 'tbody tr:nth-child(' + (item_num + 2) + ') td:nth-child(4) input'
                $(query).val(cost.toFixed(2))

                // calculate subtotal, tax, and total 
                let subtotal = 0
                for (let i = 0; i < 5; i++) {
                    subtotal += menuItems[i].cost * item_counts[i]
                }
                $('#subtotal').val(subtotal.toFixed(2))
                $('#tax').val((subtotal * 0.0625).toFixed(2))
                $('#total').val((subtotal * 1.0625).toFixed(2))
            })

            $('input').on('change', () => {
                if ($('input[value=delivery]:checked').val() == 'delivery') {
                    $('form p:nth-child(3)').css({
                        'display': 'block'
                    })
                    $('form p:nth-child(4)').css({
                        'display': 'block'
                    })
                } else {
                    $('form p:nth-child(3)').css({
                        'display': 'none'
                    })
                    $('form p:nth-child(4)').css({
                        'display': 'none'
                    })
                }
            })
        })

        /* End of my code */
    </script>

    <h1>Jade Delight</h1>
    <form   
        method="GET" 
        action="http://jimmy-maslen.great-site.net/order.php"
    >

        <p>First Name: <input type="text" name='fname' /></p>
        <p>Last Name*: <input type="text" name='lname' /></p>
        <p>Street: <input type="text" name='street' /></p>
        <p>City: <input type="text" name='city' /></p>
        <p>Phone*: <input type="text" name='phone' /></p>
        <p>
            <input type="radio" name="p_or_d" value="pickup" checked="checked" />Pickup
            <input type="radio" name='p_or_d' value='delivery' />
            Delivery
        </p>
        <table border="0" cellpadding="3">
            <tr>
                <th>Select Item</th>
                <th>Item Name</th>
                <th>Cost Each</th>
                <th>Total Cost</th>
            </tr>
            <?php
            $servername = "sql210.epizy.com";
            $username = "epiz_27829947";
            $password = "ha6ThMmfPVtZm";
            $dbname = "epiz_27829947_jade_delight";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            function makeSelect($name, $minRange, $maxRange)
            {
                $t = "<select name='" . $name . "' size='1'>";
                for ($j = $minRange; $j <= $maxRange; $j++) {
                    $t .= "<option>" . $j . "</option>";
                }
                $t .= "</select>";
                return $t;
            }

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    echo
                    '<tr>' .
                        '<td>' .
                        makeSelect("quan" . $i , 0, 10) .
                        '</td>' .
                        '<td>' .
                        $row["name"] .
                        '</td>' .
                        '<td>' .
                        $row["cost"] .
                        '</td>' .
                        '<td>' .
                        "<input name={$row["name"]} type='text'>" .
                        '</td>' .
                        '</tr>';
                    $i += 1;
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <!-- <script language="javascript">
                var s = "";
                for (i = 0; i < menuItems.length; i++) {
                    s += "<tr><td>";
                    s += makeSelect("quan" + i, 0, 10);
                    s += "</td><td>" + menuItems[i].name + "</td>";
                    s += "<td> $ " + menuItems[i].cost.toFixed(2) + "</td>";
                    s += "<td>$<input type='text' name='cost'/></td></tr>";
                }
                document.writeln(s);
            </script> -->
        </table>
        <p>Subtotal:
            $<input type="text" name='subtotal' id="subtotal" />
        </p>
        <p>Mass tax 6.25%:
            $ <input type="text" name='tax' id="tax" />
        </p>
        <p>Total: $ <input type="text" name='total' id="total" />
        </p>

        <input type="text" name="pickupMessage" style="display:none" />

        <input type="submit" value="Submit Order" />

    </form>
</body>

</html>