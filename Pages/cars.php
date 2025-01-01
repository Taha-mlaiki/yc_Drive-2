<?php include "./components/header.php" ?>
<div class="min-h-screen flex flex-col">
    <?php include "./components/navbar.php" ?>
    <div class="relative flex flex-1">
        <aside id="default-sidebar" class="w-64">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium mt-10">
                    <li>
                        <a href="./dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./cars.php" class="flex items-center p-2 bg-gray-100 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                            <img src="../assets/images/car.svg" alt="" class="w-5 h-5">
                            <span class="ms-3">Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="./categories.php" class="flex items-center p-2  text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group">
                            <img src="../assets/images/category.png" class="w-5 h-5" alt="">
                            <span class="ms-3">Categories</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="relative flex-1 p-6 overflow-auto">
            <main class="px-5 flex-grow h-full lg:px-10 mt-5">
                <div class="flex items-center justify-between mt-10">
                    <h2 class="font-semibold text-neutral-700  flex items-center gap-x-2 text-lg">
                        <img src="../assets/images/car.svg" alt="" class="w-5 h-5">
                        Cars
                    </h2>
                    <button id="open-modal" class="px-3 py-1.5 text-white rounded-lg bg-primary hover:bg-rimary/90">
                        New Car
                    </button>
                </div>
                <div class="relative overflow-x-auto mt-10 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    modal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    available
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    something
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    something
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    something
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    something
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    something
                                </th>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-primary hover:underline">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Car modal -->
    <div id="category-modal" tabindex="-1" aria-hidden="true" class="hidden flex items-center justify-center fixed inset-0  w-full min-h-screen overflow-auto py-20 z-50 bg-black/30 backdrop-blur-lg">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create new car
                    </h3>
                    <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Car name" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="modal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modal</label>
                            <input type="number" name="modal" id="modal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="2019" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">availability</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option class="text-red-700" value="Unavailable">Unavailable</option>
                                <option class="text-green-700" value="Available" selected>Available</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write Car description here"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="text-white inline-flex items-center bg-primary hover:bg-primary/90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-auto">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add new Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // review modal
    const reviewModal = document.getElementById("category-modal");
    const btnReviewModal = document.getElementById("open-modal");
    const closeReviewModal = document.getElementById("close-modal");

    btnReviewModal.addEventListener("click", () => {
        reviewModal.classList.remove("hidden");
    })
    closeReviewModal.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
    })
</script>

<?php include "./components/footer.php" ?>