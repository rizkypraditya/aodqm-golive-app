<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/img/C7FFF447-91D0-466A-9F2A-B89961C31A18-removebg-preview.png" type="image/png" sizes="16x16">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://www.flaticon.com/icons">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/sideBar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="admin.css">
  <title>AUDIHUB TELKOM</title>
</head>
<body>
   <!--SideBar Menu-->
   <div class="container-sidebar">
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <a href="#">
                        <img src="" alt="" class="icon">
                        <span class="description-header">
                            <div  style="margin-left: 20px;" >
                                <h4><b>AuditHub</b></h4>
                                <div style="color:#55565B" >
                                    <p>By Telkom</p>
                                </div>
                            </div>
                        </span>
                    </a>
                </div>
                <div class="illustration; " >
                    <img src="assets/img/telkk.jpg" style="margin-left: 40px; width: 100px; height: auto; margin-top: 20px" ; alt="">
                </div>
            </div>
            <div id="garis-garis2" style="color: #F31313"></div>
            <div style="color:#55565B; margin-top: 4px;" >
                <p>Main Menu :</p>
            </div>
            <div class="main">
                <div class="list-item">
                    <a href="admin.php">
                        <img src="assets/img/add.png" alt="" class="icon" style="width: 20px; height: auto;">
                        <span class="description">Add Report</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="Home.php">
                        <img src="assets/img/report.png" alt="" class="icon" style="width: 20px; height: auto;">
                        <span class="description">Report</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="Kuliner.php">
                        <img src="assets/img/record.png" alt="" class="icon" style="width: 20px; height: auto;">
                        <span class="description">Record</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="assets/img/History.svg" alt="" class="icon" ">
                        <span class="description">History</span>
                    </a>
                </div>
                <div id="garis-garis3"></div>
                <div class="list-item">
                    <a href="#">
                        <img src="assets/img/Setting.svg" alt="" class="icon">
                        <span class="description">Setting</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="Contact.php">
                        <img src="assets/img/contact.png" alt="" class="icon">
                        <span class="description">Contact</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="#">
                        <img src="assets/img/Help.png" alt="" class="icon">
                        <span class="description">Help</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container d-flex flex-wrap justify-content-between py-2"  style="background-color:#F31313 ; height: 65px, ">
                <div id="menu-button">
                    <input type="checkbox" id="menu-checkbox">
                    <label for="menu-checkbox" id="menu-label">
                        <div id="garis-garis"></div>
                    </label>
                </div>
                <div  style="margin-left: 200px; text-align: center; line-height: 0; color:#ffffff" >
                    <h4><b>AuditHub</b></h4>
                    <p>By Telkom</p>
                </div>
                <div class="logot">
                    <h6>{{ Auth::user('')->name }}!
                        <img src="assets/img/BAGAS.jpg" alt="" class="icon" style="width: 30px; height: auto; margin-right: 4px;">
                        <img src="assets/img/bell.png" alt="" class="ico" style="width: 20px; height: auto;margin-left: 10px;">
                        <svg style="margin-left: 20px;" clxmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="currentColor" class="bi-bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                    </a></h6>
                </div>
            </div>
            <div class="conten" style="margin-right:500px; top:-200px;"> 
                <div class="col-md-6" style="margin-top: 20px; letter-spacing: 3px;" >
                    <h6><b style="color: #F31313">Role</b><b style="color: black">:</b><b style="color: black">Mitra</b></h6>
                </div>
                <div class="form-container">
                    <button class="back-button">Back</button>
                    <h5>Add Report</h5>
                    <div class="sender-info">
                        <p>Nama Pengirim: {{ Auth::user()->name }}!</p>
                        <p>ID: 123456789</p>
                        <p>Tgl: 15-02-2024</p>
                    </div>
                    <form>
                        <label for="projectTitle">Project Title*</label>
                        <input type="text" id="projectTitle" name="projectTitle" required>
                        
                        <label for="fileKML">Upload File KML (only .kml)</label>
                        <input type="file" id="fileKML" name="fileKML" accept=".kml">
                        
                        <label for="fileMAINCORD">Upload File MAINCORD (only .xix)</label>
                        <input type="file" id="fileMAINCORD" name="fileMAINCORD" accept=".xix">
                        
                        <label for="fileABD">Upload File ABD (only .pdf)</label>
                        <input type="file" id="fileABD" name="fileABD" accept=".pdf">
                        
                        <label for="fileGambar">Upload File Gambar (only .jpg)</label>
                        <input type="file" id="fileGambar" name="fileGambar" accept=".jpg">
                        
                        <button type="submit" class="upload-button">UPLOAD</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/sideBar.js"></script>
</body>
</html>

