<!DOCTYPE html>
<html>

<head>
    <title>IT Software LGITIN</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<style>
    body {
    background: #f3f3f3;
    color: #333;
    width: 100%;
    font-family: sans-serif;
    margin: 0 auto;
}

.header {
    width: 90%;
    margin: auto;
    height: 120px;
    line-height: 30px;
    background: rgb(177, 174, 174);
    color: #fff;
}

.header p {
    width: 90%;
    margin: 10px;
    margin-left: 2px;
    font-size: 30px;
    height: 80px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.jarak img {
    margin-top: 10px;
}

.menu {
    background-color: #484a4b;
    height: 50px;
    line-height: 50px;
    position: relative;
    width: 90%;
    margin: 0 auto;
    padding: 0 auto;
}

.jarak {
    margin-top: 0px;
    padding: 0 2pc;
}

.menu ul {
    list-style: none;
}

.menu ul p {
    margin-top: 2px;
    float: auto;
    font-size: 20px;
    color: #FFF;
    font-weight: bold;
    font-family: Copperplate, Papyrus, fantasy;
}

.menu ul li a {
    float: left;
    width: 50px;
    text-align: left;
    color: #FFF;
    text-decoration: none;
}

.btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 30px;
    cursor: pointer;
    font-size: 15px;
}

.btn:hover {
    background-color: RoyalBlue;
}

.content {
    width: 90%;
    margin: auto;
    height: 420px;
    padding: 0.1px;
    background: #fff;
    color: #333;
    overflow: auto;
}

.border {
    border: 2px solid #4887b9;
    margin-top: 1pc;
    margin-bottom: 1pc;
    margin-right: 1pc;
    padding-bottom: 1pc;
    padding-left: 2pc;
    padding-right: 2pc;
}

.kiri {
    width: 70%;
    float: inline-start;
    margin: auto;
    background: #fff;
    height: 420px;
}

.kanan {
    width: 20%;
    float: left;
    margin: auto;
    background: #fff;
    height: 420px;
}

.footer {
    width: 90%;
    height: 40px;
    line-height: 40px;
    background: #333;
    color: #fff;
    position: relative;
    bottom: 0;
    margin: auto;
    
}
</style>
<body>
    <div class="header">
        <div class="jarak">
            <img src="images/logo_lgitin.png">
            <p>Welcome to IT Software collections LGIT IN</p>
        </div>
    </div>
    <div class="menu">
        <ul>
            <p>IT Software</p>
        </ul>
    </div>
    <div class="content">
        <div class="jarak">
            <!-- kiri -->
            <div class="kiri">
                <!-- blog -->
                <div class="border">
                    <div class="jarak">
                        <h3>Adobe Reader DC</h3>
                        <p>Program Adobe Reader DC merupakan program untuk membuka file pdf</p>
                        <button class="btn" onclick="document.location.href='AcroRdrDC2000920063_en_US.exe';">Download ..</button>
                    </div>
                </div>
                <!-- end blog -->
                <!-- blog -->
                <div class="border">
                    <div class="jarak">
                        <h3>AlSoft</h3>
                        <p>Program AlSoft adalah program untuk membuka file yang berbentuk foto atau gambar (AlSee) dan
                            untuk mengcompress file (AlZip)</p>
                        <button class="btn" onclick="document.location.href='02. AlSoft.zip';">Download ..</button>
                    </div>
                </div>
                <div class="border">
                    <div class="jarak">
                        <h3>LG Smart Font</h3>
                        <p>Instalasi untuk penggunaan LG Smart font</p>
                        <button class="btn">Download ..</button>
                    </div>
                </div>
                <!-- end blog -->
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="jarak">
            <p>copyright @IT2022</p>
        </div>
    </div>
</body>

</html>