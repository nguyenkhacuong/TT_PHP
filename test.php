<?php/*
        $ct = 'Hanoi';
        if(isset($_GET['city'])){
            $ct = $_GET['city'];
        };
       $string = "http://api.openweathermap.org/data/2.5/weather?q=$ct&units=metric&appid=444a59a1d25fe586945b880dcc3b7c6b";
       $response  = file_get_contents($string);
       $data  = json_decode($response,true);
       $temp = $data['main']['temp'];
      
       $humidity = $data['main']['humidity'];
       $today = date("d/m/Y");
       $wind = $data['wind']['speed'];
       $icon = $data['weather'][0]['icon'];
    //    echo($icon);
    switch ($ct) {
        case 'Hanoi':
            $city = "Hà Nội";
            break;
        case 'Haiphong':
            $city = "Hải Phòng";
            break;
        case 'Saigon':
            $city = "TP Hồ Chí Minh";
            break;
        case 'hue':
            $city = "Huế";
            break;
        case 'vinh':
            $city = "TP Vinh";
            break;
        default:
            $city = ($data['name']);
            break;
        
    } */
?>
<style>
    .allw{
        background-color: #F9D7F3;
        width: 300px;
        /* height: 200px; */
        /* margin-left: 50%;
        transform:translateX(-50%); */
        border-radius: 8px;
        padding: 10px;
        padding-right: 0px !important;
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        color: #000;
        margin-right: 12px;
    }
    .bleftw{
        padding: 5px;
        display: flex;
        flex-direction: row;
    }
    .myiconw{
        width: 70px;
        height: 70px;
    }
    .page-main{
        font-family: Arial, Helvetica, sans-serif;
    }
    .rightw{
        margin-right:10px;
    }
</style>
    
<div class="allw" id="weather">
    
    <div class="leftw">
        <form method="GET" action="#weather">
            <select name="city" id="city">
                <option>Chọn thành phố</option>
                <option value="Hanoi">Hà Nội</option>
                <option value="Saigon">TP Hồ Chí Minh</option>
                <option value="Haiphong">Hải Phòng</option>
                <option value="hue">Huế</option>
                <option value="vinh">TP Vinh</option>
            </select>
            <input type="submit" value="ok">
        </form>
        <div class="hleftw">
            <h3 style=" margin: 2px 0px;"><?php echo($city) ?></h3>
            <p style="font-size: 14px; margin: 2px 0px;"><?php echo($today) ?></p>
        </div>
        <div class="bleftw">
            <div style = "font-size: 32px; font-weight: bold; font-style: italic; color:darkslategrey"><?php echo($temp) ?></div>
            <div style="margin-top: 4px;">&ensp;°C</div>
        </div>
    </div>
    <div class="rightw">
        <img class="myiconw" src="https://openweathermap.org/img/w/<?php print_r($icon) ?>.png" alt="may troi">
        <p style="margin: 2px 0px;font-size: 14px;">Độ ẩm : <?php echo($humidity) ?> %</p>
        <p style="font-size: 14px;margin: 2px 0px;">Tốc độ gió : <?php echo($wind) ?> m/s</p>
    </div>
</div>