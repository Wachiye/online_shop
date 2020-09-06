<?php
include("details.php");
include_once('../db_control.php');
$access = new Access();

if(empty($_POST['mpesa_code']) && empty($_POST['amount']) && empty($_POST['order']))
{
    echo '<script language="javascript"> alert("No MPesa code detected. Please fill out the code, amount and the order id")
			document.location.href = "wallet.php" ; </script>'; 
}
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        /*get id and mpesa code*/
        $my_id = $_SESSION['myid'];
        $mpesa_code =$access->clean($_POST['mpesa_code']);
        $amount = $access->clean($_POST['amount']);
        $order = $_POST['order'];
        /*query to check amount*/
        $sql = "SELECT * FROM transactions WHERE mpesa_code = '$mpesa_code'";
        /*execute query*/
        $result = $access->query($sql);
        $count = $access->rows($result);
        if ($count == 0)
        {
            //$rows = mysqli_fetch_row($result);
            $data = "INSERT INTO transactions(id_number,mpesa_code,amount,service_type) VALUES($my_id,'$mpesa_code',$amount,'Deposit for order id $order')";
            if($access->query($data))
            {
                $credit = mysqli_fetch_row($access->query("SELECT amount FROM debts WHERE user_id =$my_id"))[0];
                $update = "UPDATE debts set amount = debts.amount - $amount, service ='Initial Credit:$credit,Paid $amount for order $order' WHERE user_id =$my_id";
                if($access->query($update))
                {
                    $access->query("INSERT INTO transactions(id_number,mpesa_code,amount,service_type) VALUES($my_id,'$mpesa_code',$amount,'Initial Credit:$credit,Paid $amount for order $order')");
                    sleep(2);
                    header("location: wallet.php");
                }
                else
                {
                    printf("Error: Could not process your MPESA code.Please try again later %s", mysqli_error($access->conn));
                    exit();
                }
            }
            else 
            {
                printf("Error occured while process the MPESA Code. %s", mysqli_error($access->conn));
                sleep(3);
                exit();
            }
        }
        else
        {
            #printf(mysqli_error($db_server));
            echo '<script language="javascript"> alert("M-Pesa code already exits. Try again later")
			document.location.href = "wallet.php" ; </script>';
        }
        
    }
    
    ?>