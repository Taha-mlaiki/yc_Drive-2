<?php
include "./components/header.php" ?>
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
                                    Image
                                </th>
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
                        <tbody id="car_list">

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
                <form class="p-4 md:p-5" id="carsForm">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="car_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Car name">
                            <span id="nameError" class="text-red-500 text-sm mt-1 hidden">Name is required</span>
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image url</label>
                            <input type="url" name="name" id="img_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="type url image">
                            <span id="img_url_err" class="text-red-500 text-sm mt-1 hidden">Image url is required</span>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="car_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999">
                            <span id="priceError" class="text-red-500 text-sm mt-1 hidden">Price is required and must be a number</span>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="car_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="list_categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                            </select>
                            <span id="categoryError" class="text-red-500 text-sm mt-1 hidden">Category is required</span>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="car_modal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modal</label>
                            <input type="number" name="modal" id="car_modal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="2019">
                            <span id="modalError" class="text-red-500 text-sm mt-1 hidden">Modal is required</span>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="car_available" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Availability</label>
                            <select id="car_available" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="0">Unavailable</option>
                                <option value="1" selected>Available</option>
                            </select>
                            <span id="availabilityError" class="text-red-500 text-sm mt-1 hidden">Availability is required</span>
                        </div>
                        <div class="col-span-2">
                            <label for="car_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Car Description</label>
                            <textarea id="car_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write Car description here"></textarea>
                            <span id="descriptionError" class="text-red-500 text-sm mt-1 hidden">Description is required</span>
                        </div>
                        <input type="hidden" id="car_id_form" value="">
                    </div>
                    <div class="flex justify-end">
                        <button id="modal-btn" type="submit" class="text-white inline-flex items-center bg-primary hover:bg-primary/90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-auto">
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
<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-50"></div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const showToast = (message, type = 'success') => {
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `p-4 rounded shadow text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;

        toastContainer.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    };
    // review modal
    const reviewModal = document.getElementById("category-modal");
    const btnReviewModal = document.getElementById("open-modal");
    const closeReviewModal = document.getElementById("close-modal");

    const fetchCategories = async () => {
        const res = await axios.get("../actions/category/view.php")
        let list_placeholder = document.getElementById("list_categories")
        list_placeholder.innerHTML = "";
        let catData = [];
        if (res.data.categories) {
            catData = res.data.categories;
        }
        catData.map((ele) => {
            list_placeholder.innerHTML += `
                <option value=${ele.id}>${ele.name}</option>
            `
        })
    }
    fetchCategories();

    btnReviewModal.addEventListener("click", () => {
        reviewModal.classList.remove("hidden");
        document.getElementById("car_id_form").value = "";
        document.getElementById("modal-title").textContent = "Create New Car";
        document.getElementById("modal-btn").textContent = "Create";
        // Reset input fields
        document.getElementById("car_name").value = "";
        document.getElementById("car_description").value = "";
        document.getElementById("car_modal").value = "";
        document.getElementById("car_price").value = "";
    })
    closeReviewModal.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
    })

    document.getElementById("carsForm").addEventListener("submit", async function(event) {
        event.preventDefault();
        let isValid = true;
        let inputId = document.getElementById("car_id_form")
        // Name validation
        let name = document.getElementById("car_name");
        if (!name.value.trim()) {
            document.getElementById("nameError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("nameError").classList.add("hidden");
        }
        let img_url = document.getElementById("img_url");
        if (!img_url.value.trim()) {
            document.getElementById("img_url_err").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("img_url_err").classList.add("hidden");
        }

        // Price validation
        let price = document.getElementById("car_price");
        if (!price.value || isNaN(price.value)) {
            document.getElementById("priceError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("priceError").classList.add("hidden");
        }

        // Category validation
        let category = document.getElementById("list_categories");
        if (!category.value) {
            document.getElementById("categoryError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("categoryError").classList.add("hidden");
        }

        // Modal validation
        let modal = document.getElementById("car_modal");
        if (!modal.value || isNaN(modal.value)) {
            document.getElementById("modalError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("modalError").classList.add("hidden");
        }

        // Availability validation
        let availability = document.getElementById("car_available");
        if (!availability.value) {
            document.getElementById("availabilityError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("availabilityError").classList.add("hidden");
        }

        // Description validation
        let description = document.getElementById("car_description");
        if (!description.value.trim()) {
            document.getElementById("descriptionError").classList.remove("hidden");
            isValid = false;
        } else {
            document.getElementById("descriptionError").classList.add("hidden");
        }
        if (!isValid) {
            return
        }
        if (inputId.value === "") {
            const data = {
                name: name.value,
                imgUrl: img_url.value,
                description: description.value,
                price: price.value,
                category: category.value,
                available: Number(availability.value),
                modal: modal.value
            }
            const res = await axios.post("../actions/cars/create.php", data)
            if (res.data.success) {
                name.value = ""
                img_url.value = ""
                description.value = ""
                price.value = ""
                category.value = ""
                availability.value = ""
                modal.value = ""
                reviewModal.classList.add("hidden");
                showToast(res.data.success);
                fetchCars();
            } else if (res.data.error) {
                reviewModal.classList.add("hidden");
                showToast(res.data.error, "error");
                fetchCars();
            } else {
                console.log(res.data);
            }
        } else {
            const data = {
                id: inputId.value,
                name: name.value,
                imgUrl: img_url.value,
                description: description.value,
                price: Number(price.value),
                category: Number(category.value),
                available: Number(availability.value),
                modal: modal.value
            }
            const res = await axios.post("../actions/cars/update.php", data);
            if (res.data.success) {
                showToast(res.data.success);
                reviewModal.classList.add("hidden");
                inputId.value = "";
                name.value = "";
                img_url.value = "";
                description.value = "";
                price.value = "";
                modal.value = "";
                fetchCars();
            } else {
                console.log(res);
                showToast(res.data.error, "error");
            }
        }
    });


    const carListeners = () => {
        document.querySelectorAll(".edit-car").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = btn.getAttribute("data-id");
                let findedItem = carsData.filter((ele) => ele.id == id)
                findedItem = findedItem[0];
                reviewModal.classList.remove("hidden");
                document.getElementById("modal-title").textContent = "Edit Car";
                document.getElementById("modal-btn").textContent = `Update`;
                document.getElementById("car_name").value = findedItem.name;
                document.getElementById("car_description").value = findedItem.description;
                document.getElementById("list_categories").value = findedItem.category_id;
                document.getElementById("car_modal").value = findedItem.modal;
                document.getElementById("car_price").value = findedItem.price;
                document.getElementById("car_available").value = findedItem.available.toString();
                document.getElementById("car_id_form").value = findedItem.id
            });
        });
        document.querySelectorAll(".delete-car").forEach((btn) => {
            btn.addEventListener("click", async (e) => {
                const id = btn.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this category?")) {
                    const res = await axios.post("../actions/cars/delete.php", {
                        id
                    });
                    if (res.data.success) {
                        showToast(res.data.success);
                        fetchCars();
                    } else {
                        showToast(res.data.error, "error");
                    }
                }
            });
        });
    };

    let carsData = [];
    const fetchCars = async () => {
        const res = await axios.get("../actions/cars/view.php")
        let car_list = document.getElementById("car_list")
        car_list.innerHTML = "";
        if (res.data.cars) {
            carsData = res.data.cars;
        }
        carsData.map((ele) => {
            car_list.innerHTML += `
             <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div>
                                        <img src=${ele.imgUrl} class="w-32 rounded-md" />
                                    </div>
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.name}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.modal}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.price}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.available ? `<span class="p-1.5 inline-block rounded-lg text-green-700 bg-green-150">Available</span>`:`<span class="p-1.5 rounded-lg text-red-700 bg-red-150 inline-block">Unavailable</span>`}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.category_name}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-x-1">
                                        <button class="edit-car text-green-700 bg-green-300 p-1.5 rounded-lg" data-id="${ele.id}">Edit</button>
                                        <button class="delete-car text-red-700 bg-red-300 p-1.5 rounded-lg" data-id="${ele.id}">Delete</button>
                                    </div>
                                </td>
                            </tr>
            `
        })
        carListeners();
    }
    fetchCars();
</script>

<?php include "./components/footer.php" ?>