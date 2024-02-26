<?php
    $Result = "";
    $InputUnit = "";
    $OutputUnit = "";
    $Convert2Meters = 0;

    if (isset($_POST['Switch'])) {
        $InputUnit = $_POST["InputUnit"];
        $OutputUnit = $_POST["OutputUnit"];
        $Switch = $InputUnit;
        $InputUnit = $OutputUnit;
        $OutputUnit = $Switch;
    } 
    if (isset($_POST['Submit'])) {
        $InputUnit = $_POST["InputUnit"];
        $InputValue = floatval($_POST["InputValue"]);
        $OutputUnit = $_POST["OutputUnit"];
    
        //แปลงค่าที่รับมาเป็นหน่วยเมตร
        if ($InputUnit == "mm") {
            $Convert2Meters = $InputValue/1000; 
            $ShowInputUnit ="มิลลิเมตร";
        }elseif ($InputUnit == "cm") {
            $Convert2Meters = $InputValue/100; 
            $ShowInputUnit ="เซ็นติเมตร";
        }elseif ($InputUnit == "dm") {
            $Convert2Meters = $InputValue/10; 
            $ShowInputUnit ="เดซิเมตร";
        }elseif ($InputUnit == "m") {
            $Convert2Meters = $InputValue; 
            $ShowInputUnit ="เมตร";
        }elseif ($InputUnit == "km") {
            $Convert2Meters = $InputValue*1000; 
            $ShowInputUnit ="กิโลเมตร";
        }elseif ($InputUnit == "in") {
            $Convert2Meters = $InputValue / 3.28084 / 12; 
            $ShowInputUnit ="นิ้ว";
        }elseif ($InputUnit == "ft") {
            $Convert2Meters = $InputValue / 3.28084; 
            $ShowInputUnit ="ฟุต";
        }elseif ($InputUnit == "yd") {
            $Convert2Meters = $InputValue / 3.28084 * 3; 
            $ShowInputUnit ="หลา";
        }elseif ($InputUnit == "mi") {
            $Convert2Meters = $InputValue / 3.28084 * 5280; 
            $ShowInputUnit ="ไมล์";
        }
    
        //แปลงจากหน่วยเมตรเป็นหน่วยอื่น
        $Millimeter = $Convert2Meters*1000;
        $Centimeter = $Convert2Meters*100;
        $Decimeter = $Convert2Meters*10;
        $Meter = $Convert2Meters;
        $Kilometer = $Convert2Meters/1000;
        $Feet = $Meter * 3.28084;
        $Inches = $Feet * 12;
        $Yards = $Feet / 3;
        $Miles = $Yards / 1760;
    
        //ส่งผลลัพธ์และหน่วยในปัจจุบัน
        if ($OutputUnit == "mm") {
            $Result = $Millimeter; 
            $ShowOutputUnit ="มิลลิเมตร";
        }elseif ($OutputUnit == "cm") {
            $Result = $Centimeter; 
            $ShowOutputUnit ="เซ็นติเมตร";
        }elseif ($OutputUnit == "dm") {
            $Result = $Decimeter; 
            $ShowOutputUnit ="เดซิเมตร";
        }elseif ($OutputUnit == "m") {
            $Result = $Meter; 
            $ShowOutputUnit ="เมตร";
        }elseif ($OutputUnit == "km") {
            $Result = $Kilometer; 
            $ShowOutputUnit ="กิโลเมตร";
        }elseif ($OutputUnit == "in") {
            $Result = $Inches; 
            $ShowOutputUnit ="นิ้ว";
        }elseif ($OutputUnit == "ft") {
            $Result = $Feet; 
            $ShowOutputUnit ="ฟุต";
        }elseif ($OutputUnit == "yd") {
            $Result = $Yards; 
            $ShowOutputUnit ="หลา";
        }elseif ($OutputUnit == "mi") {
            $Result = $Miles; 
            $ShowOutputUnit ="ไมล์";
        }
    
        //เรียงลำดับข้อความที่จะแสดงเป็นผลลัพธ์
        $Showtext = $InputValue;
        $Showtext .= " ";
        $Showtext .= $ShowInputUnit;
        $Showtext .= " = ";
        $Showtext .= $Result;
        $Showtext .= " ";
        $Showtext .= $ShowOutputUnit;

        //กรณีที่ไม่ได้กรอกตัวเลขใด ๆ หรือกรอกเลข 0
        if($Result==0){$Showtext = "กรุณากรอกค่าที่ต้องการแปลง";}
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Converter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body><br>
    <div class="container text-center">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 border rounded mt-2 p-2 ">
                <h2>Converter</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="InputUnit"><h4>จากหน่วย</h4></label>
                        <select class="form-control" id="InputUnit" name="InputUnit">
                            <option value="mm" <?php if ($InputUnit == "mm") {echo 'selected';} ?>>มิลลิเมตร : Millimeter (mm)</option>
                            <option value="cm" <?php if ($InputUnit == "cm") {echo 'selected';} ?>>เซ็นติเมตร : Centimeter (cm)</option>
                            <option value="dm" <?php if ($InputUnit == "dm") {echo 'selected';} ?>>เดซิเมตร : Decimeter (dm)</option>
                            <option value="m"  <?php if ($InputUnit == "m")  {echo 'selected';} ?>>เมตร : Meter (m)</option>
                            <option value="km" <?php if ($InputUnit == "km") {echo 'selected';} ?>>กิโลเมตร : Kilometer (km)</option>

                            <option value="in" <?php if ($InputUnit == "in") {echo 'selected';} ?>>นิ้ว : Inches (in)</option>
                            <option value="ft" <?php if ($InputUnit == "ft") {echo 'selected';} ?>>ฟุต : Feet (ft)</option>
                            <option value="yd" <?php if ($InputUnit == "yd") {echo 'selected';} ?>>หลา : Yards (yd)</option>
                            <option value="mi" <?php if ($InputUnit == "mi") {echo 'selected';} ?>>ไมล์ : Miles (mi)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputValue"><h4>ป้อนค่าที่ต้องการ</h4></label>
                        <input type="number" step="0.00001" class="form-control" id="InputValue" name="InputValue" 
                        value="<?php echo $InputValue; ?>">
                    </div>
                    <div class="form-group">
                        <label for="OutputUnit"><h4>เป็นหน่วย</h4></label>
                        <select class="form-control" id="OutputUnit" name="OutputUnit">
                            <option value="mm" <?php if ($OutputUnit == "mm") {echo 'selected';} ?>>มิลลิเมตร : Millimeter (mm)</option>
                            <option value="cm" <?php if ($OutputUnit == "cm") {echo 'selected';} ?>>เซ็นติเมตร : Centimeter (cm)</option>
                            <option value="dm" <?php if ($OutputUnit == "dm") {echo 'selected';} ?>>เดซิเมตร : Decimeter (dm)</option>
                            <option value="m"  <?php if ($OutputUnit == "m")  {echo 'selected';} ?>>เมตร : Meter (m)</option>
                            <option value="km" <?php if ($OutputUnit == "km") {echo 'selected';} ?>>กิโลเมตร : Kilometer (km)</option>

                            <option value="in" <?php if ($OutputUnit == "in") {echo 'selected';} ?>>นิ้ว : Inches (in)</option>
                            <option value="ft" <?php if ($OutputUnit == "ft") {echo 'selected';} ?>>ฟุต : Feet (ft)</option>
                            <option value="yd" <?php if ($OutputUnit == "yd") {echo 'selected';} ?>>หลา : Yards (yd)</option>
                            <option value="mi" <?php if ($OutputUnit == "mi") {echo 'selected';} ?>>ไมล์ : Miles (mi)</option>
                        </select>
                    </div>
                    <button type="submit" id="submit" name="Submit" class="btn btn-primary">แปลงค่า</button>
                    <button type="switch" id="switch" name="Switch" class="btn btn-primary">สลับ</button>
                </form>
                <?php 
                if (isset($_POST['Submit'])) {
                    echo "<h3>$Showtext</h3>";
                }
            ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>