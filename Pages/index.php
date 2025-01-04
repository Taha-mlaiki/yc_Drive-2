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
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by category</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </form>
            <form>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                    <option selected>Filter by modal</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </form>
        </div>
        <div id="cars_list" class="grid my-16 md:grid-cols-2 gap-10 lg:grid-cols-3 ">

        </div>
        <div class="flex items-center justify-center my-10">
            <ul class="flex items-center -space-x-px h-8 text-sm">
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                </li>
                <li>
                    <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

    const fetchCarsData = async () => {
        const res = await axios.get("../actions/cars/view.php")
        carsData = res.data.cars
        appendData();
    }
    fetchCarsData();

    const appendData = () => {
        cars_list.innerHTML = "";
        console.log(carsData);
        carsData.map((ele) => {
            cars_list.innerHTML += `
                <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm">
                <img
                    alt=""
                    src=${ele.imgUrl}
                    class="h-56 w-full object-cover" />

                <div class="p-4 sm:p-6">
                    <a href="#">
                        <h3 class="text-lg font-medium text-gray-900">
                            ${ele.name}
                        </h3>
                    </a>

                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        ${ele.description}
                    </p>
                    <a href="./vehicleDetails.php?id=${ele.id}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-primary">
                        View details
                        <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                            &rarr;
                        </span>
                    </a>
                </div>
            </article>
            `
        })
    }
</script>

<?php require_once "./components/footer.php"; ?>