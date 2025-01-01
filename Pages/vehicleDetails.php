<?php
require_once "./components/header.php";
require_once "./components/navbar.php";
?>
<main class="container">
    <div class="grid md:grid-cols-2 mt-16 xl:mt-24 gap-10">
        <div class="w-full">
            <img src="../assets/images/rangerover.jpg" alt="" class="rounded-md w-full">
        </div>
        <div class="h-full  flex flex-col justify-between py-3">
            <div class="mb-10">
                <h1 class="text-2xl lg:text-4xl mb-3 font-bold">Title of this car is gonna be here</h1>
                <p class="text-neutral-700 text-sm mb-4 lg:max-w-[90%]">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam doloribus sed provident delectus placeat ipsa minus ullam! Cupiditate omnis nisi tenetur beatae similique, dolore, sequi repellendus doloremque nobis minima sed!</p>
                <span class="inline-block p-1 font-bold rounded-xl text-xs text-green-700 bg-green-300">
                    Available
                </span>
                <div class="mt-3">
                <span class="font-bold text-blue-500">Modal :</span>
                2022
            </div>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold">120$</span>
                <button class="px-2 py-1.5 rounded-lg text-white bg-primary hover:bg-primary/90">
                    Book now
                </button>
            </div>
        </div>
    </div>
</main>
<?php  
require_once "./components/navbar.php";
?>