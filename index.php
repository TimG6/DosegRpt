<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doseg RPT</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<div class="naslov">Doseg repetitorjev</div>
<div class="main">
    <form method="post">
        <div id="podatki">
        <div>Klicni znak</div>
        <input type="text" name="klicni" required />
        <div>QTH</div>
        <input type="text" name="qth" required/>
        <div id="container" class="container">
            <span class="line">Izberite Repetitor ▼</span><br>
                <div id="list" class="hide">
                    <?php
                        require_once ('config.php');  
                        $conn = mysqli_connect($database_host, $database_username, $database_password, $database_name) or die('Napaka');
                        $q="SELECT IDr,imeRep FROM repetitor ORDER BY imeRep";
                        $s=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($s,$q)) echo "napaka";
                        mysqli_stmt_execute($s);
                        $res=mysqli_stmt_get_result($s);
                        while($data=mysqli_fetch_assoc($res)){
                            echo '<input type="checkbox" name="rpt[]" value="'.$data['IDr'].'"/>'.$data['imeRep'].'<br>';
                        }
                    ?>
                </div>
        </div>
        </div>
        <input type="submit" name="submit" value="Vnos"/>
    </form>
    <br>
    <form method="post">
        <input type="submit" name="izpis" value="Izpis"/>
    </form>
</div>
<div class="avtor">Avtor: Tim Guzelj</div>
    <script>
        document.getElementsByClassName('line')[0].onclick = function neki() {
            document.getElementById("list").classList.toggle("list");
        }
    </script>
    <?php
    require_once ('config.php'); 
    if(isset($_POST["submit"])){
        extract($_POST);
        $conn = mysqli_connect($database_host, $database_username, $database_password, $database_name) or die('Napaka');
        $q="INSERT INTO uporabnik(KlicniZnak,Lokator) VALUES (?,?)";
        $q1="SELECT EXISTS(SELECT KlicniZnak FROM uporabnik WHERE KlicniZnak=?)";
        $q2="UPDATE uporabnik SET KlicniZnak=?, Lokator=? WHERE KlicniZnak=?";
        $q3="SELECT IDu FROM uporabnik WHERE KlicniZnak=?";
        $q4="INSERT INTO doseg VALUES(?,?)";
        $q5="DELETE FROM doseg WHERE IDu=?";

        $s=mysqli_stmt_init($conn);
        

        $klicni=strtoupper($klicni);
        $qth=strtoupper($qth);

        //obstaja?
        if(!mysqli_stmt_prepare($s,$q1)) echo "napaka";
        mysqli_stmt_bind_param($s,"s",$klicni);
        mysqli_stmt_execute($s);

        $res=mysqli_stmt_get_result($s);
        $data=mysqli_fetch_array($res);

        //Update
        if($data[0]==1){

            if(!mysqli_stmt_prepare($s,$q2)) echo "napaka";
            mysqli_stmt_bind_param($s,"sss",$klicni,$qth,$klicni);
            mysqli_stmt_execute($s);

        }
        //Insert
        else if($data[0]==0){
           
            if(!mysqli_stmt_prepare($s,$q)) echo "napaka";
            mysqli_stmt_bind_param($s,"ss",$klicni,$qth);
            mysqli_stmt_execute($s);

        }

        //IDu   
        if(!mysqli_stmt_prepare($s,$q3)) echo "napaka";
        mysqli_stmt_bind_param($s,"s",$klicni);
        mysqli_stmt_execute($s);
        $res=mysqli_stmt_get_result($s);
        $data=mysqli_fetch_array($res);
        $IDu=$data[0];

        if(!mysqli_stmt_prepare($s,$q5)) echo "napaka";
            mysqli_stmt_bind_param($s,"i",$IDu);
            mysqli_stmt_execute($s);
        
        foreach($rpt as $v){
            if(!mysqli_stmt_prepare($s,$q4)) echo "napaka";
            mysqli_stmt_bind_param($s,"ii",$IDu,$v);
            mysqli_stmt_execute($s);
        }

        mysqli_close($conn);
    }
    if(isset($_POST["izpis"])){
        $tab=[];
        $st=[];
        $j=0;
        $i=0;
        $znak='';
        $conn = mysqli_connect($database_host, $database_username, $database_password, $database_name) or die('Napaka');
        $q="SELECT KlicniZnak,Lokator,Imerep,Fin,Fout FROM uporabnik u INNER JOIN doseg d ON(u.IDu=d.IDu)
        INNER JOIN repetitor r ON (r.IDr=d.IDr) ORDER BY KlicniZnak";
        $res=mysqli_query($conn, $q);
        echo '<table>';
        echo '<tr>
                <td colspan="4" class="invis">
                    <form method="post"> 
                    
                        <input type="text" name="iskanjeK" placeholder="Klicni znak"/>
                        <button type="submit" name="isciK">
                        <span class="material-symbols-outlined">search</span>
                        </button>

                        <span class="slash">/</span>

                        <input type="text" name="iskanjeRep" placeholder="Repetitor"/>
                        <button type="submit" name="isciR">
                        <span class="material-symbols-outlined">search</span>
                        </button>

                    </form>
                </td>
                <td class="invis" > </td>
            </tr>';
        echo '<tr><th>Klicni znak</th><th>QTH</th><th>Repetitor</th><th>Input [MHz]</th><th>Output [MHz]</th></tr>';
        
        while($data=mysqli_fetch_assoc($res)){
            $tab[$i]=$data;
            $i++;
        }
        foreach($tab as $v){
            if($znak!=$v['KlicniZnak']){ 
                $znak=$v['KlicniZnak'];
                $st[$znak]=1;
                $j=1;
            }
            foreach($v as $k=> $x){
                if($k=='Imerep') $st[$znak]+=$j;
            }
        }
        $znak='';
        foreach($tab as $key=>$v){
            if($znak!=$v['KlicniZnak']){ 
                $znak=$v['KlicniZnak'];
                echo '<tr><th rowspan="'.$st[$znak].'">'.$znak.'</th>'.'<td rowspan="'.$st[$znak].'">'.$v['Lokator'].'</td></tr>';
            }
            echo '<tr>';
            foreach($v as $key2=> $x){
                if($key2!='KlicniZnak' && $key2!='Lokator')
                   echo '<td>'.$v[$key2].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        mysqli_close($conn);
    }
    if(isset($_POST["isciK"])){
        extract($_POST);
        $tab=[];
        $st=[];
        $j=0;
        $i=0;
        $znak='';
        $conn = mysqli_connect($database_host, $database_username, $database_password, $database_name) or die('Napaka');
        $q="SELECT KlicniZnak,Lokator,Imerep,Fin,Fout FROM uporabnik u INNER JOIN doseg d ON(u.IDu=d.IDu)
        INNER JOIN repetitor r ON (r.IDr=d.IDr) WHERE KlicniZnak=?";

        $iskanje=strtoupper($iskanjeK);

        $s=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($s,$q)) echo "napaka";

        mysqli_stmt_bind_param($s,"s",$iskanjeK);
        mysqli_stmt_execute($s);

        $res=mysqli_stmt_get_result($s);

        echo '<table>';
        echo '<tr>
                <td colspan="4" class="invis" >
                    <form method="post"> 
                    
                        <input type="text" name="iskanjeK" placeholder="Klicni znak"/>
                        <button type="submit" name="isciK">
                        <span class="material-symbols-outlined">search</span>
                        </button>

                        <span class="slash">/</span>

                        <input type="text" name="iskanjeRep" placeholder="Repetitor"/>
                        <button type="submit" name="isciR">
                        <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                </td>
                <td class="invis" > </td>
            </tr>';
        echo '<tr><th>Klicni znak</th><th>QTH</th><th>Repetitor</th><th>Input [MHz]</th><th>Output [MHz]</th></tr>';
        
        while($data=mysqli_fetch_assoc($res)){
            $tab[$i]=$data;
            $i++;
        }
        foreach($tab as $v){
            if($znak!=$v['KlicniZnak']){ 
                $znak=$v['KlicniZnak'];
                $st[$znak]=1;
                $j=1;
            }
            foreach($v as $k=> $x){
                if($k=='Imerep') $st[$znak]+=$j;
            }
        }
        $znak='';
        foreach($tab as $key=>$v){
            if($znak!=$v['KlicniZnak']){ 
                $znak=$v['KlicniZnak'];
                echo '<tr><th rowspan="'.$st[$znak].'">'.$znak.'</th>'.'<td rowspan="'.$st[$znak].'">'.$v['Lokator'].'</td></tr>';
            }
            echo '<tr>';
            foreach($v as $key2=> $x){
                if($key2!='KlicniZnak' && $key2!='Lokator')
                   echo '<td>'.$v[$key2].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        mysqli_close($conn);
    }
    if(isset($_POST["isciR"])){
        extract($_POST);
        $tab=[];
        $st=[];
        $j=0;
        $i=0;
        $znak='';
        $conn = mysqli_connect($database_host, $database_username, $database_password, $database_name) or die('Napaka');
        $q="SELECT KlicniZnak,Lokator,Imerep,Fin,Fout FROM uporabnik u INNER JOIN doseg d ON(u.IDu=d.IDu)
        INNER JOIN repetitor r ON (r.IDr=d.IDr) WHERE Imerep=?";

        $iskanje=strtoupper($iskanjeK);

        $s=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($s,$q)) echo "napaka";

        mysqli_stmt_bind_param($s,"s",$iskanjeRep);
        mysqli_stmt_execute($s);

        $res=mysqli_stmt_get_result($s);

        echo '<table>';
        echo '<tr>
                <td colspan="4" class="invis" >
                    <form method="post"> 
                    
                        <input type="text" name="iskanjeK" placeholder="Klicni znak"/>
                        <button type="submit" name="isciK">
                        <span class="material-symbols-outlined">search</span>
                        </button>

                        <span class="slash">/</span>

                        <input type="text" name="iskanjeRep" placeholder="Repetitor"/>
                        <button type="submit" name="isciR">
                        <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                </td>
                <td class="invis" > </td>
            </tr>';
        echo '<tr><th>Repetitor</th><th>Input [MHz]</th><th>Output [MHz]</th><th>Klicni znak</th><th>QTH</th></tr>';
        
        while($data=mysqli_fetch_assoc($res)){
            $tab[$i]=$data;
            $i++;
        }
        foreach($tab as $v){
            if($znak!=$v['Imerep']){ 
                $znak=$v['Imerep'];
                $st[$znak]=1;
                $j=1;
            }
            foreach($v as $k=> $x){
                if($k=='Imerep') $st[$znak]+=$j;
            }
        }
        $znak='';
        foreach($tab as $key=>$v){
            if($znak!=$v['Imerep']){ 
                $znak=$v['Imerep'];
                echo '<tr><th rowspan="'.$st[$znak].'">'.$znak.'</th>'.'<td rowspan="'.$st[$znak].'">'.$v['Fin'].'</td>'.'<td rowspan="'.$st[$znak].'">'.$v['Fout'].'</td></tr>';
            }
            echo '<tr>';
            foreach($v as $key2=> $x){
                if($key2=='KlicniZnak')
                   echo '<td>'.$v[$key2].'</th>';
                else if($key2=='Lokator'){
                    echo '<td>'.$v[$key2].'</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';

        mysqli_close($conn);
    }
    ?>
</body>
</html>
