// const menu = document.getElementById('menu-label');
// const sidebar = document.getElementsByClassName('sidebar')[0];

// menu.addEventListener('click', function(){
//     sidebar.classList.toggle('hide');
// })

// menu.getElementById('sidebar').addEventListener('click', function() {
//     menu.body.classList.toggle('hide');
//   });
  
const menu = document.getElementById('menu-label');
const sidebar = document.getElementsByClassName('sidebar')[0];
const navbar = document.getElementsByClassName('navbar')[0]; // Mengambil elemen navbar
const mainContent = document.getElementsByClassName('main-content')[0]; // Mengambil elemen main content

menu.addEventListener('click', function() {
    sidebar.classList.toggle('hide');
    navbar.classList.toggle('shifted'); // Menambahkan/menghapus class shifted pada navbar
    mainContent.classList.toggle('shifted'); // Menambahkan/menghapus class shifted pada main content
});
