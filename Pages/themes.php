<?php
include "./components/header.php" ?>
<div class="min-h-screen flex flex-col">
    <?php include "./components/navbar.php" ?>
    <div class="relative flex flex-1">
        <?php include "./components/sideBar.php" ?>
        <div class="relative flex-1 p-6 overflow-auto">
            <main class="px-5 flex-grow h-full lg:px-10 mt-5">
                <div class="flex items-center justify-between mt-10">
                    <h2 class="font-semibold text-neutral-700  flex items-center gap-x-2 text-lg">
                        <img src="../assets/images/themes.svg" alt="" class="w-5 h-5">
                        Themes
                    </h2>
                    <button id="btnOpenModal" class="px-3 py-1.5 text-white rounded-lg bg-primary hover:bg-rimary/90">
                        New Theme
                    </button>
                </div>
                <div class="relative overflow-x-auto mt-10 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Theme Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Theme title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Theme description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="theme_list">
                            <tr class="text-center w-full">
                                <td colspan="4" class="py-5">
                                    loading...
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
                        Create new Theme
                    </h3>
                    <button type="button" id="btnCloseModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
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
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="hidden" id="theme_id" value="">
                            <input type="text" name="title" id="theme_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type theme title">
                            <span id="nameError" class="text-red-500 text-sm mt-1 hidden">title is required</span>
                        </div>
                        <div class="col-span-2">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image url</label>
                            <input type="url" name="image" id="img_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="type url image">
                            <span id="img_url_err" class="text-red-500 text-sm mt-1 hidden">Image url is required</span>
                        </div>
                        <div class="col-span-2">
                            <label for="theme_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Theme Description</label>
                            <textarea id="theme_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write theme description here"></textarea>
                            <span id="descriptionError" class="text-red-500 text-sm mt-1 hidden">Description is required</span>
                        </div>
                        <input type="hidden" id="car_id_form" value="">
                    </div>
                    <div class="flex justify-end">
                        <button id="modal-btn" type="submit" class="text-white inline-flex items-center bg-primary hover:bg-primary/90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-auto">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add new Theme
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
    // modal 
    const btnOpenModal = document.getElementById("btnOpenModal")
    const modal = document.getElementById("category-modal")
    const btnCloseModal = document.getElementById("btnCloseModal")
    let modalTitle = document.getElementById("modal-title")
    let modalBtn = document.getElementById("modal-btn")
    let theme_id = document.getElementById("theme_id");

    // Select the form and input elements
    const carsForm = document.getElementById('carsForm');
    let titleInput = document.getElementById('theme_title');
    let imgUrlInput = document.getElementById('img_url');
    let descriptionInput = document.getElementById('theme_description');

    // Select the error message spans
    const nameError = document.getElementById('nameError');
    const imgUrlError = document.getElementById('img_url_err');
    const descriptionError = document.getElementById('descriptionError');

    let themeData = [];

    btnCloseModal.addEventListener("click", () => {
        modal.classList.add("hidden");
        resetForm();
    })
    btnOpenModal.addEventListener("click", () => {
        modal.classList.remove("hidden")
    })

    const resetForm = () => {
        titleInput.value = "";
        descriptionInput.value = "";
        imgUrlInput.value = "";
        theme_id.value = ""; // Reset only for new form submissions
        modalTitle.textContent = "Create New Theme";
        modalBtn.textContent = "Add New Theme";
    };

    // Form validation function
    carsForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        let isValid = true;

        // Validate inputs
        if (titleInput.value.trim() === '') {
            nameError.classList.remove('hidden');
            isValid = false;
        } else {
            nameError.classList.add('hidden');
        }

        if (imgUrlInput.value.trim() === '') {
            imgUrlError.classList.remove('hidden');
            isValid = false;
        } else {
            imgUrlError.classList.add('hidden');
        }

        if (descriptionInput.value.trim() === '') {
            descriptionError.classList.remove('hidden');
            isValid = false;
        } else {
            descriptionError.classList.add('hidden');
        }

        if (!isValid) return;

        try {
            const data = {
                title: titleInput.value,
                image: imgUrlInput.value,
                description: descriptionInput.value,
            };

            let res;
            if (theme_id.value.trim() === "") {
                // Create new theme
                res = await axios.post("../actions/theme/create.php", data);
            } else {
                // Update existing theme
                data.id = theme_id.value;
                res = await axios.post("../actions/theme/update.php", data);
            }

            if (res.data.success) {
                showToast(res.data.success);
                fetchThemes(); // Refresh theme list dynamically
                modal.classList.add("hidden");
                resetForm();
            } else {
                showToast(res.data.error, 'error');
            }
        } catch (error) {
            console.error(error);
            showToast("An error occurred", "error");
        }
    });

    const fetchThemes = async () => {
        try {
            const res = await axios.get("../actions/theme/viewAll.php");
            themeData = res.data.themes
            appendThemes();
        } catch (error) {
            console.log(res)
        }
    }

    const appendThemes = () => {
        let theme_list = document.getElementById("theme_list")
        theme_list.innerHTML = ""
        if (themeData.length == 0) {

        } else {
            themeData.map((ele) => {
                theme_list.innerHTML += `
                     <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   <img src=${ele.image} class="w-32 rounded-lg aspect-video" >
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.title}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.description}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-x-1">
                                        <button onclick="onUpdateTheme(${ele.id})" class="text-blue-700 bg-blue-300 p-1.5 rounded-lg">Update</button>
                                        <button onclick="onDeleteTheme(${ele.id})" class="text-red-700 bg-red-300 p-1.5 rounded-lg">Delete</button>
                                    </div>
                                </td>
                </tr>
                `
            })
        }
    }

    fetchThemes();

    const onUpdateTheme = (id) => {
        const theme = themeData.find((item) => item.id === id);
        if (!theme) return;

        // Set the form values
        titleInput.value = theme.title;
        imgUrlInput.value = theme.image;
        descriptionInput.value = theme.description;
        theme_id.value = theme.id; // Set the ID for update

        // Open the modal for update
        modal.classList.remove("hidden");
        modalTitle.textContent = "Update Theme";
        modalBtn.textContent = "Update Theme";
    };
    const onDeleteTheme = async (id) => {
        try {
            const res = await axios.post("../actions/theme/delete.php", {
                id
            })
            if (res.data.success) {
                showToast(res.data.success)
                window.location.reload();
            } else {
                showToast(res.data.error, "error")
            }
        } catch (error) {
            console.log(error)
        }

    }
</script>

<?php include "./components/footer.php" ?>