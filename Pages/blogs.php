<?php
require_once "./components/header.php";
require_once "./components/navbar.php";


?>
<main class="container">
    <div class="flex items-center justify-center">
        <div class="relative w-full max-w-xl my-10 mx-auto bg-white rounded-full">
            <input placeholder="Search by blog title" class="rounded-full w-full h-16 bg-transparent py-2 pl-8 pr-32 outline-none border-2 border-gray-100 shadow-md hover:outline-none focus:ring-primary/50 focus:border-primary/50" type="text" name="query" id="query">
            <button type="submit" class="absolute inline-flex items-center h-10 px-4 py-2 text-sm text-white transition duration-150 ease-in-out rounded-full outline-none right-3 top-3 bg-primary/90 sm:px-6 sm:text-base sm:font-medium hover:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <svg class="-ml-0.5 sm:-ml-1 mr-2 w-4 h-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
        </div>
    </div>
    <form class="mb-20 mt-10">
        <select id="category_list" class="bg-gray-50 border border-gray-300 w-44 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
            <option selected>Filter by tags</option>
            <option>Somthing</option>
            <option>heree</option>
        </select>
    </form>
    <div class="container my-8 grid md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
            <div class="flex-shrink-0">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1679&amp;q=80" alt="">
            </div>
            <div class="flex flex-1 flex-col justify-between bg-white relative p-6">
            <img id="heart1" src="../assets/images/emptyHeart.svg" alt="" class="absolute top-2 right-2 w-10 cursor-pointer">
                <div class="flex-1">
                    <p class="text-sm font-medium text-indigo-600">
                        <a href="#" class="hover:underline">Article</a>
                    </p>
                    <a href="#" class="mt-2 block">
                        <p class="text-xl font-semibold text-gray-900">Boost your conversion rate</p>
                        <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.</p>
                    </a>
                </div>
                <div class="flex items-center mt-6 justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="#">
                                <span class="sr-only">Roel Aufderehar</span>
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                            </a>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <a href="#" class="hover:underline">Roel Aufderehar</a>
                            </p>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <time datetime="2020-03-16">Mar 16, 2020</time>
                                <span aria-hidden="true">·</span>
                                <span>6 min read</span>
                            </div>
                        </div>
                    </div>
                    <button class="px-2 py-1 rounded-md bg-primary text-white hover:bg-primary/90">
                        Read
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
     document.getElementById("heart1").addEventListener("click", function () {
        // Get the image element
        const heartImage = this;
        
        // Check the current src and toggle it
        if (heartImage.src.includes("emptyHeart.svg")) {
            heartImage.src = "../assets/images/filedHeart.svg";
        } else {
            heartImage.src = "../assets/images/emptyHeart.svg";
        }
    });
</script>


<?php require_once "./components/footer.php"; ?>