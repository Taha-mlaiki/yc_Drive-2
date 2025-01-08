<?php  

    $current_page = basename($_SERVER["PHP_SELF"]);

?>

<aside id="default-sidebar" class="w-64 ">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium mt-10">
            <li>
                <a href="./dashboard.php" class="flex items-center <?= $current_page == 'dashboard.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./cars.php" class="flex items-center <?= $current_page == 'cars.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <img src="../assets/images/car.svg" alt="" class="w-5 h-5">
                    <span class="ms-3">Cars</span>
                </a>
            </li>
            <li>
                <a href="./categories.php" class="flex items-center <?= $current_page == 'categories.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group">
                    <img src="../assets/images/category.png" class="w-5 h-5" alt="">
                    <span class="ms-3">Categories</span>
                </a>
            </li>
            <li>
                <a href="./themes.php" class="flex items-center <?= $current_page == 'themes.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <img src="../assets/images/themes.svg" alt="" class="w-5 h-5">
                    <span class="ms-3">Themes</span>
                </a> 
            </li>
            <li>
                <a href="./blogsDash.php" class="flex items-center <?= $current_page == 'blogsDash.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <img src="../assets/images/articles.svg" alt="" class="w-5 h-5">
                    <span class="ms-3">Blogs</span>
                </a> 
            </li>
            <li>
                <a href="./comments.php" class="flex items-center <?= $current_page == 'comments.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <img src="../assets/images/comments.svg" alt="" class="w-5 h-5">
                    <span class="ms-3">Comments</span>
                </a>
            </li>
            <li>
                <a href="./tags.php" class="flex items-center <?= $current_page == 'tags.php' ? 'bg-gray-100':''?> p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <img src="../assets/images/tags.svg" alt="" class="w-5 h-5">
                    <span class="ms-3">Tags</span>
                </a>
            </li>
        </ul>
    </div>
</aside>