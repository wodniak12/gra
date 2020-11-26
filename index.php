<?php 
        require('./class/Village.class.php');
        session_start();
        if(!isset($_SESSION['v'])) // jeżeli nie ma w sesji naszej wioski
        {
            echo "Tworzę nową wioskę...";
            $v = new Village();
            $_SESSION['v'] = $v;
            //reset czasu od ostatniego odświerzenia strony
            $deltaTime = 0;
        } 
        else //mamy już wioskę w sesji - przywróć ją
        {
            $v = $_SESSION['v'];
            //ilosc sekund od ostatniego odświerzenia strony
            $deltaTime = time() - $_SESSION['time'];
        }
        $v->gain($deltaTime);
        
        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    if($v->upgradeBuilding($_REQUEST['building']))
                    {
                        echo "Ulepszono budynek: ".$_REQUEST['building'];
                    }
                    else
                    {
                        echo "Nie udało się ulepszyć budynku: ".$_REQUEST['building'];
                    }
                    
                break;
                default:
                    echo 'Nieprawidłowa zmienna "action"';
            }
        }




        $_SESSION['time'] = time();
        
        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body style="background-color:   rgb(202, 115, 0);">
<header style="background-color:  rgb(109, 58, 0);">
	
    <nav class="navbar navbar-dark bg-jumpers navbar-expand-lg" >
    
        <a class="navbar-brand" href="#"> </a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="mainmenu" >
        
            <ul class="navbar-nav mt-2 mt-lg-0 mx-auto ">
            
                <li class="nav-item active" style="margin-right: 50px;" >
                <div class="dropdown">
  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Gracz
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Nick:</a>
    <a class="dropdown-item" href="#">Gildia</a>
    <button type="button" class="btn btn-warning">Wyloguj</button>
  </div>
</div>
                </li>
                <br>
                <li class="nav-item" style="margin-right: 50px;">
                <div class="dropdown">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Drewno
  </a>

  <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
                <a>Drewno</a> <?php echo $v->showStorage("wood"); ?>
                </div>
</div>
                
                </li>
                <br>
                    
               
                
                <li class="nav-item" style="margin-right: 50px;">
                    <div class="dropdown">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Metal
  </a>

  <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
                <a>Metal</a>  
        <?php echo $v->showStorage("iron"); ?>
                </div>
</div>
                </li>
                <br>


                <li class="nav-item">
                <div class="dropdown">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Jedzenie
  </a>

  <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
  <a>Jedzenie</a>  
        <?php echo $v->showStorage("food"); ?>
        
    

                </div>
</div>
                </li>



                <li class="nav-item">
                <div class="dropdown">
  <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Wioska
  </a>

  <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
  Drwal,<br>
         poziom <?php echo $v->buildingLVL("woodcutter"); ?> <br>
        Zysk/h: <?php echo $v->showHourGain("wood"); ?><br>
        <a href="index.php?action=upgradeBuilding&building=woodcutter">
            <button>Rozbuduj drwala</button>
        </a>

                
                
     Kopalnia żelaza,<br>
         poziom <?php echo $v->buildingLVL("ironMine"); ?> <br>
        Zysk/h: <?php echo $v->showHourGain("iron"); ?><br>
        <a href="index.php?action=upgradeBuilding&building=ironMine">
            <button>Rozbuduj kopalnie żelaza</button>
        </a>
                </div>
</div>
                </li>

                <br>

                <li class="nav-item" style="margin-right: 50px;">
                
                </li>
                
            
            </ul>
            
        </div>
    
    </nav>

</header>



  <img src="plemiona1.png" alt="wioska" style=" margin-left: auto; margin-right: auto; margin-top: 100px;">

    



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>