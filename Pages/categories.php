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
                        <a href="./cars.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                            <img src="../assets/images/car.svg" alt="" class="w-5 h-5">
                            <span class="ms-3">Cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="./categories.php" class="flex items-center p-2 bg-gray-100 text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group">
                            <img src="../assets/images/category.png" class="w-5 h-5" alt="">
                            <span class="ms-3">Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="./comments.php" class="flex items-center p-2  text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                            <img src="../assets/images/car.svg" alt="" class="w-5 h-5">
                            <span class="ms-3">Comments</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="relative flex-1 p-6 overflow-auto">
            <main class="px-5 flex-grow h-full lg:px-10 mt-5">
                <div class="flex items-center justify-between mt-10">
                    <h2 class="font-semibold text-neutral-700  flex items-center gap-x-2 text-lg">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                        </svg>
                        Categories
                    </h2>
                    <button id="open-modal" class="px-3 py-1.5 text-white rounded-lg bg-primary hover:bg-rimary/90">
                        New category
                    </button>
                </div>
                <div class="relative overflow-x-auto mt-10 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Categories
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="list_categories">

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Category modal -->
    <div id="category-modal" tabindex="-1" aria-hidden="true" class="hidden flex items-center justify-center fixed inset-0  w-full min-h-screen overflow-auto py-20 z-50 bg-black/30 backdrop-blur-lg">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create new category
                    </h3>
                    <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="categoryForm" action="" method="post">
                    <div class="mb-3">
                        <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Nanme</label>
                        <input type="text" id="category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary" placeholder="lux" />
                        <small id="category_name_error" class="text-red-600 mt-1 hidden"></small>
                        <input type="hidden" id="category_id_form" value="">
                    </div>
                    <input
                        id="modal-btn"
                        type="submit"
                        name="create"
                        class="text-white flex items-center gap-x-1 font-semibold bg-primary hover:bg-primary/90 px-3 py-2 rounded-lg ms-auto" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Toast Notifications -->
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

    btnReviewModal.addEventListener("click", () => {
        const inputId = document.getElementById("category_id_form");
        inputId.value = "";
        document.getElementById("category_name").value = "";
        document.getElementById("modal-title").textContent = "Create category";
        document.getElementById("modal-btn").value = "Create";
        reviewModal.classList.remove("hidden");
    })
    closeReviewModal.addEventListener("click", () => {
        reviewModal.classList.add("hidden");
    })

    const formSubmit = () => {
        document.getElementById("categoryForm").addEventListener("submit", async (e) => {
            e.preventDefault();

            const categoryInput = document.getElementById("category_name");
            const categoryError = document.getElementById("category_name_error");
            const categoryName = categoryInput.value.trim();
            const inputId = document.getElementById("category_id_form");

            let isValid = true;
            // Check if category name is empty
            if (!categoryName) {
                isValid = false;
                categoryError.textContent = "Category name is required.";
                categoryError.classList.remove("hidden");
            } else if (categoryName.length < 3) {
                isValid = false;
                categoryError.textContent = "Category name must be at least 3 characters.";
                categoryError.classList.remove("hidden");
            } else {
                categoryError.textContent = "";
                categoryError.classList.add("hidden");
            }
            if (!isValid) {
                return
            }
            if (inputId.value === "") {
                const res = await axios.post("../actions/category/create.php", {
                    categoryName,
                })
                if (res.data.success) {
                    categoryInput.value = ""
                    reviewModal.classList.add("hidden");
                    showToast(res.data.success);
                    fetchCategories();
                } else if (res.data.error) {
                    categoryInput.value = ""
                    reviewModal.classList.add("hidden");
                    showToast(res.data.error, "error");
                    fetchCategories();
                } else {
                    console.log(res.data);
                }
            } else {
                const res = await axios.post("../actions/category/update.php", {
                    id: inputId.value,
                    categoryName,
                });
                if (res.data.success) {
                    showToast(res.data.success);
                    reviewModal.classList.add("hidden");
                    document.getElementById("category_name").value = "";
                    inputId.value.value = "";
                    fetchCategories();
                } else {
                    showToast(res.data.error, "error");
                }
            }

        })
    }
    formSubmit();
    const attachCategoryListeners = () => {
        document.querySelectorAll(".edit-category").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = btn.getAttribute("data-id");
                const name = btn.getAttribute("data-name");

                reviewModal.classList.remove("hidden");
                document.getElementById("modal-title").textContent = "Edit category";
                document.getElementById("modal-btn").value = "Update";
                document.getElementById("category_name").value = name;
                document.getElementById("category_id_form").value = id;
            });
        });

        document.querySelectorAll(".delete-category").forEach((btn) => {
            btn.addEventListener("click", async (e) => {
                const id = btn.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this category?")) {
                    const res = await axios.post("../actions/category/delete.php", {
                        id
                    });
                    if (res.data.success) {
                        showToast(res.data.success);
                        fetchCategories();
                    } else {
                        showToast(res.data.error, "error");
                    }
                }
            });
        });
    };

    const fetchCategories = async () => {
        const res = await axios.get("../actions/category/view.php")
        let list_placeholder = document.getElementById("list_categories")
        list_placeholder.innerHTML = "";
        let data = [];
        if (res.data.categories) {
            data = res.data.categories;
        }
        data.map((ele) => {
            list_placeholder.innerHTML += `
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        ${ele.name}
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-x-1">
                            <button class="edit-category text-green-700 bg-green-300 p-1.5" data-id="${ele.id}" data-name="${ele.name}">Edit</button>
                            <button class="delete-category text-red-700 bg-red-300 p-1.5" data-id="${ele.id}">Delete</button>
                        </div>
                    </td>
                </tr>
            `
        })
        attachCategoryListeners();
    }
    fetchCategories();
</script>
<?php include "./components/footer.php" ?>