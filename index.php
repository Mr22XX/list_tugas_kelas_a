<?php
session_start();
include "conn.php";

if(isset($_POST['kirim'])){
    $nama = htmlspecialchars($_POST['nama']);
    $desk = htmlspecialchars($_POST['desk']);

    $query = "INSERT INTO tugas (nama, desk) VALUES ('$nama', '$desk')";

    
    $hasil = mysqli_query($conn, $query);

    if($hasil){
        echo "
        <script>
            alert('Tugas berhasil tersimpan ding')
        </script>
        ";
    }
    else{
        echo "
        <script>
            alert('Tugas gagal tersimpan ding')
        </script>
        ";
    }
}

if(isset($_GET['hal'])){
    if($_GET['hal'] === "hapus"){
        if(isset($_SESSION['login'])){

            $query = "DELETE FROM tugas WHERE id = '$_GET[id]'";
            $hasil = mysqli_query($conn, $query);
    
            if($hasil){
                echo "
                <script>
                    alert('Tugas berhasil terhapus ding');
                    window.location.href = 'index.php';
                </script>
                ";
            }
            else{
                echo "
                <script>
                    alert('Tugas gagal terhapus ding')
                    window.location.href = 'index.php';
                </script>
                ";
            }
        }
        else{
            echo "
            <script>
                alert('Hanya admin yang bisa menghapus tugas')
                    window.location.href = 'index.php';

            </script>
            ";
        }
    }
}

if(isset($_POST['edit'])){
    if($_GET['hal'] === "edit"){
        $query = "UPDATE tugas SET 
        nama = '$_POST[nama]',
        desk = '$_POST[desk]'
        "
        ;
        $hasil = mysqli_query($conn, $query);

        if($hasil){
            echo "
            <script>
                alert('Tugas berhasil diedit ding')
                window.location.href = 'index.php';
            </script>
            ";
        }
        else{
            echo "
            <script>
                alert('Tugas gagal diedit ding')
                window.location.href = 'index.php';
            </script>
            ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tugas Kelas A</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet"></body>
</head>
<body>
    <div class="nav">
        <div class="navbar">
            <img src="./img/logo.png" alt="logo" width="120px">
            <button id="darkmode">Dark Mode</button>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div style="display: flex; justify-content: space-around; gap: 50px; align-items: center;">
                <h2 style="padding:8px;  font-size: 35px;font-weight: bold;"  class="font1">Class A Task List</h2>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal">
                    <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path  stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>

            </div>
            <div style="display: flex; flex-direction: column; gap: 20px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                <?php
                $query = "SELECT * FROM tugas";
                $hasil = mysqli_query($conn, $query);

                while($data = mysqli_fetch_assoc($hasil)){

                
                
                ?>
                <div style="display: flex; justify-content: space-between; gap: 20px;">

                    <div>
                        <h2 style="font-size: 20px;"><?="Nama Mata Kuliah: " . $data['nama']?></h2>
                        <p><?="Tugas : " .$data['desk']?></p>
                    </div>
                    <div style="display: flex; gap: 10px;">

                    <a href="#">
                        <button onclick="adminOnly()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                    </a>

                        
                        <a href="index.php?hal=hapus&id=<?=$data['id']?>">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </a>
                        
                    </div>
                </div>
                    <?php 
                }
                ?>
            </div>
        </div>
    </div>














    <!-- modal -->
     



<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambahkan Tugas
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Mata Kuliah</label>
                        <input type="text" name="nama" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Matkulnyo ding" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Tugas</label>
                        <textarea id="description" name="desk" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Apo tugasnyo ding?"></textarea>                    
                    </div>
                </div>
                <button type="submit" name="kirim" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambahkan
                </button>
            </form>
        </div>
    </div>
</div> 




    <script>
        const btn = document.getElementById('darkmode');
        const body =document.body;
        const container =document.querySelector(".container")
        btn.addEventListener("click", darkMode);

        function darkMode(){
            console.log("akt")
            body.classList.toggle("darkMode");
            container.classList.toggle("container-dark")
            

            if(body.classList.contains("darkMode")){
                btn.innerText = "Light Mode";
            }
            else{
                btn.innerText = "Dark Mode";
            }
        }

        const adminOnly = () =>{
            alert('Hanya admin yang bisa mengedit')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>