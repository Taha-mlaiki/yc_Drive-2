<?php
require_once "./components/header.php";
require_once "./components/navbar.php";


?>

<main>
    <div class="container flex items-center justify-center">
        <div>
            <h1 class="text-center text-3xl my-4 font-bold text-primary">Here some Text</h1>
            <p class="text-neutral-600 text-center mx-auto text-sm max-w-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim placeat, quisquam expedita voluptates ex quibusdam aliquid, facere ducimus ullam eos consequuntur aperiam voluptatibus </p>
            <img src="../assets/images/carLand.png" alt="" class="mx-auto">
        </div>
    </div>
    <div class="container">
        <span class="relative my-5 flex justify-center">
            <div
                class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-transparent bg-gradient-to-r from-transparent via-gray-500 to-transparent opacity-75"></div>
            <span class="relative z-10 bg-white px-6 font-bold text-xl text-gray-700">Cars</span>
        </span>
        <div class="flex gap-x-3">
            <form>
                <select id="category_list" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by category</option>
                </select>
            </form>
            <form>
                <select id="modal_list" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by modal</option>
                </select>
            </form>
            <button onclick="clearFilter()" class="px-2 py-2 rounded-lg bg-gray-200 border text-sm">
                Clear Filter
            </button>
        </div>
        <div id="cars_list" class="grid my-16 md:grid-cols-2 gap-10 lg:grid-cols-3 ">

        </div>
        <div class="flex items-center justify-center my-10">
            <ul class="flex items-center -space-x-px h-8 text-sm">
                <li>
                    <a id="previous_btn" onclick="fetchCarsData(currentPage - 1)"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                </li>
                <div id="pagination_list" class="flex items-center -space-x-px h-8 text-sm">

                </div>
                <li>
                    <a id="next_btn" onclick="fetchCarsData(currentPage + 1)"
                        class="flex cursor-not-allowed  items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let cars_list = document.getElementById("cars_list");
    let carsData = [];
    let filteredData = [];
    let category_list = document.getElementById("category_list");
    let modal_list = document.getElementById("modal_list");
    let pagination_list = document.getElementById("pagination_list");
    let currentPage = 1;
    const limit = 10;
    let totalPages = 1;

    const clearFilter = () => {
        filteredData = carsData;
        appendData();
    }

    const appendCategories = () => {
        let categories = Array.from(new Set(carsData.map(ele => ele.category_name)));
        category_list.innerHTML = "";
        categories.map((cat) => {
            let option = document.createElement("option");
            option.value = cat;
            option.innerHTML = cat;
            category_list.appendChild(option);
        });
        watchCategory();
    }

    const watchCategory = () => {
        category_list.addEventListener("change", (e) => {
            filteredData = carsData.filter((ele) => ele.category_name == e.target.value);
            appendData();
        });
    }

    const appendModal = () => {
        let modals = Array.from(new Set(carsData.map(ele => ele.modal)));
        modal_list.innerHTML = "";
        modals.map((cat) => {
            let option = document.createElement("option");
            option.value = cat;
            option.innerHTML = cat;
            modal_list.appendChild(option);
        });
        watchModal();
    }

    const watchModal = () => {
        modal_list.addEventListener("change", (e) => {
            console.log(e.target.value);
            filteredData = carsData.filter((ele) => ele.modal == e.target.value);
            appendData();
        });
    }

    const appendPagination = () => {
        pagination_list.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            pagination_list.innerHTML += `
                <li>
                    <a onclick="fetchCarsData(${i})" class="flex items-center justify-center px-3 h-8 leading-tight ${currentPage == i ? "text-blue-600 border border-gray-300 bg-blue-50" : "text-gray-500 bg-white border border-gray-300" }  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i}</a>
                </li>
            `;
        }
    }

    const fetchCarsData = async (clickedPage) => {
        if (clickedPage && clickedPage < 1 || (totalPages && clickedPage > totalPages)) return;

        currentPage = clickedPage;
        const res = await axios.post("../actions/cars/view.php", {
            page: clickedPage || 1,
            limit
        });
        totalPages = res.data.totalPages; // Ensure totalPages is updated
        appendPagination(); // No need to pass totalPages now
        carsData = res.data.cars;
        filteredData = carsData;
        appendData();
        appendCategories();
        appendModal();

        const nextBtn = document.getElementById("next_btn");
        const prevBtn = document.getElementById("previous_btn");

        if (currentPage <= 1) {
            prevBtn.classList.add("cursor-not-allowed", "opacity-50");
        } else {
            prevBtn.classList.remove("cursor-not-allowed", "opacity-50");
        }

        if (currentPage >= totalPages) {
            nextBtn.classList.add("cursor-not-allowed", "opacity-50");
        } else {
            nextBtn.classList.remove("cursor-not-allowed", "opacity-50");
        }
    }

    fetchCarsData(1); 

    const appendData = () => {
        cars_list.innerHTML = "";
        filteredData.map((ele) => {
            cars_list.innerHTML += `
                <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
                    <img alt="" src=${ele.imgUrl} class="h-56 w-full object-cover" />
                    <div class="p-4 sm:p-6">
                        <a href="#">
                            <h3 class="text-lg font-medium text-gray-900">${ele.name}</h3>
                        </a>
                        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">${ele.description}</p>
                        <a href="./vehicleDetails.php?id=${ele.id}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-primary">
                            View details
                            <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">&rarr;</span>
                        </a>
                    </div>
                </article>
            `;
        });
    }
</script>


<?php require_once "./components/footer.php"; ?>