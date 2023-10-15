<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Tux.png">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <title>Převodník</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Převody číselných soustav<span class="blinking_cursor"> ▍</h1>
        </div>
        <div class="form__container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
                <div class="grid__container">
                    <div class="valNum">
                        <span class="brackets"></span>
                        <input type="text" id="num" name="num" value=
                        <?php 
                        if(isset($_GET['num'])){
                            echo ($_GET['num']);
                        }
                        else{
                            echo "128";
                        }
                        ?> 
                         maxlength="9" size="1" required="required">
                        <span class="brackets"></span>               
                        <sub>
                            <input type="text" class="numSys" name="numSys" required="required" value=<?php 
                        if(isset($_GET['numSys'])){
                            echo ($_GET['numSys']);
                        }
                        else{
                            echo "10";
                        }
                        ?> 
                        maxlength="2" size="2">
                        </sub>
                    </div>
                    <div class="toNumSys">
                        <label for="toSys">do soustavy </label>
                        <input type="text" id="toSys" name="toSys" required="required" value=
                        <?php 
                        if(isset($_GET['toSys'])){
                            echo ($_GET['toSys']);
                        }
                        else{
                            echo "2";
                        }
                        ?> 
                        maxlength="3" size="9">
                    </div>
                </div>
                <input type="submit" class="submit_button" name="submit" value="Převést">
            </form>
            <div class="baseValue">
                <?php
                if(isset($_GET['submit'])){
                    $num = $_GET['num'];
                    $numSys = $_GET['numSys'];
                    $toSys = $_GET['toSys'];
                    if($numSys>36 || $toSys>36){
                        echo "<span style='color:red;''> Error < data-type=float overflow ></span>";
                    }else{
                        echo "<h2 style='color:lime;'>(".calculateNumber($num, $numSys, $toSys).")<sub>".$toSys."</sub></h2>";
                    }
                }       
                ?>
            </div>
        </div>

    </div>
    <div class="footer">
        <span class="link"><a href="https://www.pojfm.cz" target="_blank"><b>POJ</b></a></span>
        <span><script type="text/javascript">document.write( new Date().getFullYear() );</script></span>
        <span>Jakub Farník</span>
    </div>
<?php

function toDecimal($number, $numberSystem){
    return base_convert($number, $numberSystem, 10);
}
function fromDecimal($number,$toSystem){
    return strtoupper(base_convert($number, 10, $toSystem));
}

function calculateNumber($number, $numberSystem, $toSystem){
    if($numberSystem==10){
        return fromDecimal($number, $toSystem);
    }
    if($toSystem==10){
        return toDecimal($number, $numberSystem);   
    }
    return fromDecimal(toDecimal($number,$numberSystem), $toSystem);
}
?>
</body>
</html>