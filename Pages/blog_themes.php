<?php
require_once "./components/header.php";
require_once "./components/navbar.php";


?>

<main class="mt-5">
    <div class="container">
        <h1 class="text-neutral-600 text-3xl underline font-semibold">Themes</h1>
        <div class="grid md:grid-cols-2 lg:grid-cols-3">
            <a href="#" class="relative w-full isolate flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-40 max-w-sm mx-auto mt-24">
                <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a" alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                <h3 class="z-10 mt-3 text-3xl font-bold text-white">Paris</h3>
                <div class="z-10 gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">City of love</div>
            </a>
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