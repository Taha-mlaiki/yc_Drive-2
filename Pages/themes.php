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
                        <tbody id="car_list">
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.name}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.modal}
                                </th>
                                <th scope="row" class="px-6 w-full py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${ele.price}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-x-1">
                                        <button class="delete-car text-red-700 bg-red-300 p-1.5 rounded-lg" data-id="${ele.id}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
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
</script>

<?php include "./components/footer.php" ?>